<?php

namespace App\Http\Controllers;

use App\Facades\ILINX;
use App\Models\Call;
use App\Models\Discussion;
use App\Models\Email;
use App\Models\Layout;
use App\Models\Note;
use App\Models\Utility;
use App\Services\ILINX\DocumentViewer;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller {

    public function index() {

        $tasks = self::fetchTaskList();
        foreach ($tasks->Data as $viewInfo) {
            $viewInfo->encodeTaskName = Crypt::encryptString($viewInfo->ViewName);
        }
        if ($tasks->Success == true) {
            $tasks = $tasks->Data;

            foreach ($tasks as $key => $val) {
                if ($val->ViewName == 'CaseMgmtGetUserCase') {
                    unset($tasks[$key]);
                    break;
                }
            }
            return view('tasks.index', compact('tasks'));
        }

        return redirect()->back()->with('error', $tasks->ErrorMessage);
    }

    public static function fetchTaskDetail($name) {
        $json = ILINX::view()->show($name);

        $err = new \stdClass();
        if (empty($json)) {
            // Return some appropriate error to user here
            Utility::ILINXLog('ERROR taskDetail ILINX execute-view error: EMPTY json results: ' . $json);

            $err->Success      = false;
            $err->ErrorMessage = __('An error occurred attempting to retrieve task details.');

            return $err;
        }
        if ($json->Success != 'true') {
            // Return some appropriate error to user here
            Utility::ILINXLog('ERROR taskDetail ILINX execute-view REST error: ' . $json->ErrorMessage);

            $err->Success      = false;
            $err->ErrorMessage = __('An error occurred attempting to retrieve task details.');

            return $err;
        }

        return $json;
    }

    // public function taskDetail($taskName, $viewId = '') {
    //     $response   = self::fetchTaskDetail($taskName);
    //     $taskDetail = [];
    //     $titles     = [];
    //     $isSuccess  = false;

    //     if ($response->Success == true) {
    //         $isSuccess = true;

    //         if (count($response->Data) > 0) {
    //             $titles     = (array) $response->Data[0];
    //             $titles     = array_keys($titles);
    //             $taskDetail = json_decode(json_encode($response->Data), true);
    //         }

    //         $removeArr = [
    //             'ActiveBatchID',
    //             'BatchProfileID',
    //             'ICM_EFORM',
    //         ];

    //         foreach ($removeArr as $r) {
    //             $remove = array_search($r, $titles);
    //             unset($titles[$remove]);
    //         }
    //     }

    //     $layout = Layout::where('id', $viewId)->first();

    //     $eformUrl = '';

    //     if (!is_null($layout)) {
    //         $eformUrl = $layout->eform_url;
    //     }

    //     return view('tasks.detail', compact('taskName', 'taskDetail', 'titles', 'viewId', 'isSuccess', 'eformUrl'));
    // }

    // Fetch Dashboard card
    public static function fetchTaskList() {
        // Check the age of the FolderIndex object in the cache
        $taskObjCacheTime = Session::get('taskObjCacheTime');
        if (!empty($taskObjCacheTime)) {
            if (time() - $taskObjCacheTime < env('ILINX_CACHE_TIMEOUT')) {
                // Our cache is fresh, return the cached object
                $cachedTaskObj = Session::get('taskObj');
                if (!empty($cachedTaskObj)) {
                    return $cachedTaskObj;
                }
            }
        }

        $taskObj = ILINX::view()->setBaseUrl(config('ilinx.ic_url'))->index();

        if (empty($taskObj)) {
            Utility::ILINXLog('ERROR taskIndex ILINX get-views error: EMPTY json results: ' . $taskObj);

            // Return some appropriate error to user here
            $err               = new \stdClass();
            $err->Success      = false;
            $err->ErrorMessage = __('An error occurred attempting to retrieve the list of work tasks.');

            return $err;
        }
        if (isset($taskObj)) {
            if ($taskObj->Success != 'true') {
                // Return some appropriate error to user here
                Utility::ILINXLog('ERROR taskIndex ILINX get-views REST error: ' . $taskObj->ErrorMessage);

                $err               = new \stdClass();
                $err->Success      = false;
                $err->ErrorMessage = __('An error occurred attempting to retrieve the list of work tasks.');

                return $err;
            }
        }

        Utility::ILINXLog('DEBUG Task List get-views success');

        // Update the batch docs into the cache and store the time
        Session::put('taskObjCacheTime', time());
        Session::put('taskObj', $taskObj);

        return $taskObj;
    }

    public function taskEformDetail($encodeTaskName, $title, $batchId) {
        $usrData = Session::get('userInfo');
        $title = Utility::base64url_decode($title);

        $response = ILINX::form()->link($batchId);
        $url      = $response->Data;

        return view('tasks.eform_detail', compact('encodeTaskName', 'title', 'url', 'usrData'));
    }

    // Ajax Call for fetch task details
    public function fetchData(Request $request) {
        $response = [];

        if (!empty($request->batchId)) {
            Utility::ILINXLog('**** fetchData calling get-batch-docs');

            $returnHTML = '';

            if ($request->type == 'document') {
                $documentData = [];

                $dataResult = ILINX::docs()->setBaseUrl(config('ilinx.ic_url'))->index($request->batchId);

                $tableHeader = [];

                foreach ($dataResult->Data as $key => $doc) {
                    if ($doc->DocTypeName == $request->docName) {
                        // Table Header
                        if (count($tableHeader) == 0) {
                            foreach ($doc->IndexValues as $value) {
                                if (\Str::contains($value->IndexName, [
                                        '[',
                                        ']',
                                    ]) != true) {
                                    array_push($tableHeader, $value->IndexName);
                                }
                            }
                        }
                        $documentData[Utility::GetDocProp($doc, $tableHeader[0]) . '-' . $key] = $doc;
                    }
                }

                if (isset($request->orderBy) && !empty($request->orderBy)) {
                    if ($request->orderBy == 'asc') {
                        ksort($documentData);
                    } elseif ($request->orderBy == 'desc') {
                        krsort($documentData);
                    } else {
                        $documentData = array_reverse($documentData);
                    }
                } else {
                    $documentData = array_reverse($documentData);
                }

                $returnHTML = view('tasks.docList', compact('tableHeader', 'documentData'))->render();
                if (isset($request->viewType) && !empty($request->viewType)) {
                    if ($request->viewType == 'grid') {
                        $returnHTML = view('tasks.docGrid', compact('tableHeader', 'documentData'))->render();
                    } else {
                        $returnHTML = view('tasks.docList', compact('tableHeader', 'documentData'))->render();
                    }
                }

                $response = [
                    'is_success' => true,
                    'from'       => 'document',
                    'html'       => $returnHTML,
                    'total_docs' => count($documentData) . __(' documents'),
                    'msg'        => __('Success'),
                ];
            } elseif ($request->type == 'subtask') {
                $response = ILINX::batch()->setBaseUrl(config('ilinx.ic_url'))->show($request->batchId);

                $data        = $response->Data;
                $tableHeader = [];
                $tableBody   = [];
                $table       = $request->taskName;

                foreach ($data->IndexValues as $val) {
                    if ($val->DataType == '_table' && $val->IndexName == $request->taskName) {
                        // Table Header
                        if (count($tableHeader) == 0) {
                            foreach ($val->TableValue->Columns as $value) {
                                array_push($tableHeader, $value->ColumnName);
                            }
                        }

                        foreach ($val->TableValue->RowValues as $k => $v) {
                            if (count($tableHeader) > 0) {
                                $arr = [];
                                foreach ($tableHeader as $header) {
                                    $arr[$header] = Utility::GetTableRowColumnValue($v->ColumnValues, $header);
                                }
                                $tableBody[array_values($arr)[0] . '-' . $k] = $arr;
                            }
                        }

                        break;
                    }
                }

                if (isset($request->orderBy) && !empty($request->orderBy)) {
                    if ($request->orderBy == 'asc') {
                        ksort($tableBody);
                    } elseif ($request->orderBy == 'desc') {
                        krsort($tableBody);
                    } else {
                        $tableBody = array_reverse($tableBody);
                    }
                } else {
                    $tableBody = array_reverse($tableBody);
                }

                $returnHTML = view('tasks.taskList', compact('tableHeader', 'tableBody', 'table'))->render();

                if (isset($request->viewType) && !empty($request->viewType)) {
                    if ($request->viewType == 'grid') {
                        $returnHTML = view('tasks.taskGrid', compact('tableHeader', 'tableBody', 'table'))->render();
                    } else {
                        $returnHTML = view('tasks.taskList', compact('tableHeader', 'tableBody', 'table'))->render();
                    }
                }

                $response = [
                    'is_success'    => true,
                    'from'          => 'subtask',
                    'html'          => $returnHTML,
                    'total_subtask' => count($tableBody) . __(' tasks'),
                    'msg'           => __('Success'),
                ];
            }
        } else {
            $response = [
                'is_success' => false,
                'msg'        => __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'),
            ];
        }

        return response()->json($response);
    }

    public function taskListingDetail($encodeTaskName, $title, $batchId) {
        $response = ILINX::batch()->setBaseUrl(config('ilinx.ic_url'))->show($batchId);

        $data = $response->Data;
        $title = Utility::base64url_decode($title);

        // Get Other Details
        $otherData = [];

        if (env('BATCH_DISCUSSION_SHOW') == true) {
            $discc                   = Discussion::where('batch_id', 'LIKE', $data->BatchID)->get();
            $otherData['discussion'] = (!empty($discc) ? $discc : []);
        }
        if (env('BATCH_NOTES_SHOW') == true) {
            $otherData['notes'] = Note::where('batch_id', 'LIKE', $data->BatchID)->first();
        }
        if (env('BATCH_CALLS_SHOW') == true) {
            $call               = Call::where('batch_id', 'LIKE', $data->BatchID)->get();
            $otherData['calls'] = (!empty($call) ? $call : []);
        }
        if (env('BATCH_EMAILS_SHOW') == true) {
            $emails              = Email::where('batch_id', 'LIKE', $data->BatchID)->get();
            $otherData['emails'] = (!empty($emails) ? $emails : []);
        }

        $docList            = [];
        $subTaskList        = [];
        $arrHeader          = [];
        $arrNonSystemHeader = [];

        if (count($data->Docs) > 0) {
            foreach ($data->Docs as $docs) {
                array_push($docList, $docs->DocTypeName);
            }
        }

        $arrNonSystemHeader['Batch ID']           = $data->BatchID;
        $arrNonSystemHeader['Batch Profile Name'] = $data->BatchProfileName;

        foreach ($data->IndexValues as $val) {
            if ($val->DataType == '_table') {
                if (env('BATCH_SUBTASKS_SHOW') == true) {
                    array_push($subTaskList, $val->IndexName);
                }
            }

            if (\Str::contains($val->IndexName, [
                    '[',
                    ']',
                ]) != true) {
                $arrHeader[$val->IndexName] = $val->IndexValue;
            } else {
                $arrNonSystemHeader[str_replace(
                    [
                        '[',
                        ']',
                    ],
                    [
                        '',
                        '',
                    ],
                    $val->IndexName
                )] = $val->IndexValue;
            }
        }

        $removeFromArray = [
            "Created location",
            "Total docs",
            "Total pages",
            "Max allowable docs",
            "Max allowable pages",
            "Display thumbnail and index side-by-side",
            "Default doc type",
            "Copy index values when splitting docs",
        ];

        foreach ($removeFromArray as $key) {
            unset($arrNonSystemHeader[$key]);
        }

        $arrNonSystemHeader = array_merge($arrHeader, $arrNonSystemHeader);

        // If no non-system index value found then
        if (count($arrHeader) == 0) {
            foreach ($data->IndexValues as $val) {
                if ($val->IndexName == '[Batch name]' || $val->IndexName == '[Date created]') {
                    $arrHeader[str_replace(
                        [
                            '[',
                            ']',
                        ],
                        [
                            '',
                            '',
                        ],
                        $val->IndexName
                    )] = $val->IndexValue;
                    //                    array_push($arrHeader, $val->IndexValue);
                }
            }
        }
        // end

        $otherData['docList'] = array_unique($docList);
        if (env('BATCH_SUBTASKS_SHOW') == true) {
            $otherData['subTaskList'] = array_unique($subTaskList);
        }

        return view(
            'tasks.detail_description',
            compact('encodeTaskName', 'title', 'response', 'otherData', 'arrHeader', 'arrNonSystemHeader')
        );
    }

    public function fetchDetail(Request $request) {
        $response = [];

        $usrData = Session::get('userInfo');
        //        $dataBatch = HomeController::getMenu();

        if ($request->type == 'document') {
            if (isset($request->docId) && !empty($request->docId)) {
                $docId    = $request->docId;
                $document = HomeController::getDocById($request->batchId, $docId)->Data;

                $arrDocData                = [];
                $arrDocData['DocTypeName'] = $document->DocTypeName;
                $arrDocData['DocTitle']    = $document->IndexValues[0]->IndexValue;

                $frameUrl   = config('ilinx.ic_url') . 'get-doc?batchID=' . $request->batchId . '&docID=' . $docId . '&fileFormat=pdf';
                $docuViewareControlHtml = DocumentViewer::getDocView();
                $returnHTML = view('tasks.docDetail', compact('arrDocData', 'frameUrl', 'usrData' ,'docId', 'docuViewareControlHtml'))->render();

                $response = [
                    'is_success' => true,
                    'from'       => 'document',
                    'html'       => $returnHTML,
                    'msg'        => __('Success'),
                ];
            } else {
                $response = [
                    'is_success' => false,
                    'msg'        => __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'),
                ];
            }
        } elseif ($request->type == 'subtask') {
            if (isset($request->link) && !empty($request->link)) {
                $arrTaskData['batchName'] = !empty($request->batchName) ? $request->batchName : '';
                $arrTaskData['title']     = !empty($request->title) ? $request->title : '';
                $url                      = $request->link;

                $returnHTML = view('tasks.taskDetail', compact('arrTaskData', 'url', 'usrData'))->render();

                $response = [
                    'is_success' => true,
                    'from'       => 'subtask',
                    'html'       => $returnHTML,
                    'msg'        => __('Success'),
                ];
            } else {
                $response = [
                    'is_success' => false,
                    'msg'        => __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'),
                ];
            }
        }

        return response()->json($response);
    }

    public function getFile(Request $request) {
        $usrData = Session::get('userInfo');

        $url      = $request->get('url');
        $response = Http::withHeaders([
            'Username'      => $usrData->Username,
            'SecurityToken' => $usrData->SecurityToken,
        ])->get($url);

        if ($response->status() === 500) {
            $url = str_replace("&fileFormat=pdf", "&fileFormat=native", $url);
            $res = Http::withHeaders([
                'Username'      => $usrData->Username,
                'SecurityToken' => $usrData->SecurityToken,
            ])->get($url);

            if ($res->status() === 200) {
                $ret = response()->make($res, 200);
                $ret->header('Content-Type', $res->header("Content-Type"));
                return $ret;
            } else {
                return response()->json(['error' => "Error found"], 500);
            }
        } else {
            $ret = response()->make($response, 200);
            $ret->header('Content-Type', $response->header("Content-Type"));
            return $ret;
        }

    }

    public function taskFilter(Request $request, $encodeTaskName, $viewId = null) {
        $taskName = Crypt::decryptString($encodeTaskName);
        $response = self::getViewDefinition($taskName);

        if (!$response?->Success) {
            //if error exist and is
            if ($request->get('action') == 'back-page' && $request->get('isFromNotification')) {
                return redirect()->route('tasks.index', tenant('tenant_id'));
            }

            return redirect()->back()->with('error', $response->ErrorMessage);
        }

        $getViewDefinition = $response->data;
        $isRequired        = $response->required_flags;

        $layout   = Layout::where('id', $viewId)->first();
        $eformUrl = '';
        if (!is_null($layout)) {
            $eformUrl = $layout->eform_url;
        }

        $searchDatumsLastTaskFilter = [];

        $lastTaskName = Session::get('taskName', []);
        $lastTaskFilter     = Session::get('SearchDatums_lastTaskFilter', []);

        if ($taskName == $lastTaskName && !empty($lastTaskFilter) && $request->action == 'back-page') {
            $searchDatumsLastTaskFilter = $lastTaskFilter;
        } else {
            self::clearSearchDatumsTaskFilter();
        }
        foreach ($getViewDefinition as $index => $item) {
            if ($item->Required) {
                $isRequired = true;
            }
        }

        return view(
            'tasks.filter',
            compact('encodeTaskName', 'isRequired', 'getViewDefinition', 'viewId', 'eformUrl', 'searchDatumsLastTaskFilter')
        );
    }

    private static function getViewDefinition($name) {
        try {
            $json = ILINX::view()->searchWorkflowView($name);
        } catch (IlinxException $exception) {
            $json = (object) [
                'Success'      => false,
                'ErrorMessage' => $exception->getMessage(),
            ];
        }

        $searchData    = [];
        $requiredFlags = false;

        if ($json->Success != true) {
            return $json;
        }

        if ($json->Data && $json->Data->SearchFields && count($json->Data->SearchFields) > 0) {
            foreach ($json->Data->SearchFields as $val) {
                if ($val->FieldName != 'TenantId') {
                    $searchData[] = $val;

                    $requiredFlags = $val->Required;
                }

                if ($val->FieldType == 6) {
                    $picklist = ['' => __('None')];

                    if (count($val->PickListFieldValues) > 0) {
                        foreach ($val->PickListFieldValues as $value) {
                            $picklist[$value] = $value;
                        }
                    }
                    $val->PickListFieldValues = $picklist;
                }
            }
        }

        $response                 = new \StdClass();
        $response->Success        = true;
        $response->required_flags = $requiredFlags;
        $response->data           = $searchData;

        return $response;
    }

    public function clearSearchDatumsTaskFilter() {
        Session::forget('taskName');
        Session::forget('SearchDatums_lastTaskFilter');
    }

    public function taskDetail(Request $request, $encodeTaskName) {
        $taskName     = Crypt::decryptString($encodeTaskName);
        $searchDatums = [];
        $valid        = [];
        $searchData   = [];

        foreach ($request->input() as $key => $value) {
            if (is_array($value)) {
                $searchDatumsJson = json_decode($value['json']);

                if ($searchDatumsJson->Required == true) {
                    if ($value['input'] == "") {
                        $valid[] = $key . " " . __("field is required.");
                    }
                }

                $searchDatumsJson->FieldValue = $value['input'] ?? '';

                $searchDatums[] = $searchDatumsJson;

                $searchData[] = (object) [
                    'input'      => $searchDatumsJson->FieldValue,
                    'field_name' => $searchDatumsJson->FieldName,
                ];
            }
        }

        session(['taskName' => $taskName, 'SearchDatums_lastTaskFilter' => $searchData]);

        if (count($valid) > 0) {
            $messages = implode(PHP_EOL, $valid);

            return response()->json([
                'is_success' => false,
                'message'    => $messages,
            ]);
        }

        $taskDetail   = [];
        $titles       = [];
        $isSuccess    = false;

        try {
            $response = ILINX::view()->showWithDataNum($taskName, $searchDatums);
        } catch (IlinxException $exception) {
            $response = (object) [
                'Success'      => false,
                'ErrorMessage' => $exception->getMessage(),
            ];
        }

        // $is_ICS_AppName = false;

        if ($response->Success == true) {
            $isSuccess = true;

            if (count($response->Data) > 0) {
                $titles = (array) $response->Data[0];
                // if (!empty($titles['ICS_AppName'])) {
                //     $is_ICS_AppName = $titles['ICS_AppName'];
                // }
                unset($titles['Ident'], $titles['ICS_DocumentID'], $titles['ICS_AppName']);
                $titles       = array_keys($titles);
                $taskDetail = json_decode(json_encode($response->Data), true);
            }

            $removeArr = [
                'ActiveBatchID',
                'BatchProfileID',
                'ICM_EFORM',
            ];

            foreach ($removeArr as $r) {
                $remove = array_search($r, $titles);
                unset($titles[$remove]);
            }
        }

        $error_message = $response->ErrorMessage;

        $currColNames = explode(', ', env('CURRENCY_COLUMN_NAMES'));

        //lowercase column names to get uniformity
        $currColNames = array_map('strtolower', $currColNames);
        $currSign = env('CURRENCY_SYMBOL');

        $returnHTML = view('tasks.detail', compact('encodeTaskName', 'taskDetail', 'titles', 'isSuccess', 'error_message', 'currColNames', 'currSign'))->render();

        return response()->json([
            "is_success"     => true,
            "html"           => $returnHTML,
            // "is_ICS_AppName" => $is_ICS_AppName,
        ]);
    }


}
