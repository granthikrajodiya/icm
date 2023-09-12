<?php

namespace App\Http\Controllers;

use App\Exceptions\IlinxException;
use App\Facades\ILINX;
use App\Models\Layout;
use App\Models\Utility;
use App\Services\ILINX\DocumentViewer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

/**
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 */
class FolderController extends Controller
{
    public function index()
    {
        $folders = self::fetchFolderList();
        foreach ($folders->Data as $viewInfo) {
            $viewInfo->encodeFolderName = Crypt::encryptString($viewInfo->ViewName);
        }

        if ($folders->Success == true) {
            $folders = $folders->Data;

            return view('folders.index', compact('folders'));
        }

        return redirect()->back()->with('error', $folders->ErrorMessage);
    }

    public static function fetchFolderDetail($name) {
        return ILINX::view()->show($name);
    }

    public function folderFilter(Request $request, $encodeFolderName, $viewId = null) {
        $folderName = Crypt::decryptString($encodeFolderName);
        $response   = self::getViewDefinition($folderName);

        if (!$response?->Success) {
            //if error exist and is
            if ($request->get('action') == 'back-page' && $request->get('isFromNotification')){
                return redirect()->route('folder.index', tenant('tenant_id'));
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

        $searchDatumsLastFilter = [];

        $lastFolderName = Session::get('folderName', []);
        $lastFilter     = Session::get('SearchDatums_lastFilter', []);

        if ($folderName == $lastFolderName && !empty($lastFilter) && $request->action == 'back-page') {
            $searchDatumsLastFilter = $lastFilter;
        } else {
            self::clearSearchDatumsFilter();
        }
        foreach ($getViewDefinition as $index => $item) {
            if($item->Required){
                $isRequired = true;
            }
        }

        return view(
            'folders.filter',
            compact('encodeFolderName', 'isRequired', 'getViewDefinition', 'viewId', 'eformUrl', 'searchDatumsLastFilter')
        );
    }

    public function folderListingDetail($encodeFolderName, $repositoryName, $docId, Request $request)
    {
        $data       = explode('~', $encodeFolderName);
        $encodeFolderName = $data[0];
        $folderName = Crypt::decryptString($encodeFolderName);
        $listName   = $data[1];
        $usrData    = Session::get('userInfo');
        $frameUrl   = config('ilinx.ics_url') . 'get-doc?repositoryName=' . $repositoryName . '&docID=' . $docId . '&fileFormat=pdf';

        $isFromNotification = $request->has('notification');

        // Commented out. This is the old version of setting property sessions on documents
        // $openDocs = session()->get('openDocProperties') ?? [];
        // $isDocPropertiesOpen = in_array($docId, $openDocs);
        // !-- End --!

        $newOpenDocProps = session()->get('newDocProperties') ?? NULL;
        $docuViewareControlHtml = DocumentViewer::getDocView();

        return view('folders.listing_detail', compact('frameUrl', 'usrData', 'encodeFolderName', 'listName','docId','repositoryName','isFromNotification', 'newOpenDocProps', 'docuViewareControlHtml'));
    }

    public function folderGetDocument(Request $request)
    {
        $usrData = Session::get('userInfo');

        $url = $request->url;

        $response = Http::withHeaders([
            'Username'      => $usrData->Username,
            'SecurityToken' => $usrData->SecurityToken,
        ])->get($url);

        if ($response->failed() && $response->getReasonPhrase() === 'Security token has expired.') {
            return redirect()->route('logout', [tenant('tenant_id')])->send();
        }

        if($response->status() === 404){
            $url = str_replace("&fileFormat=pdf", "", $url);
            $response = Http::withHeaders([
                'Username'      => $usrData->Username,
                'SecurityToken' => $usrData->SecurityToken,
            ])->get($url);

            if($response->status() === 200){
                $body = $response->body();
                $res = response()->make($body, 200);
                $res->header('Content-Type',  $response->header("Content-Type"));
                return $res;
            }else {
                return response()->json(['error' => "Error found"], 500);
            }

        }else if($response->status() === 500) {
            return response()->json(['message' => "User $usrData->Username access denied"], 500);
        }else {
            $body = $response->body();
            $res = response()->make($body, 200);
            $res->header('Content-Type',  $response->header("Content-Type"));

            return $res;
        }

    }

    public function folderDetail(Request $request, $encodeFolderName)
    {
        $searchDatums = [];
        $valid        = [];
        $searchData   = [];
        $folderName   = Crypt::decryptString($encodeFolderName);

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

                $searchData[] = (object)[
                    'input'      => $searchDatumsJson->FieldValue,
                    'field_name' => $searchDatumsJson->FieldName
                ];
            }
        }

        session(['folderName' => $folderName, 'SearchDatums_lastFilter' => $searchData]);

        if (count($valid) > 0) {
            $messages = implode(PHP_EOL, $valid);

            return response()->json([
                'is_success' => false,
                'message'    => $messages,
            ]);
        }

        $folderDetail = [];
        $titles       = [];
        $isSuccess    = false;

        try {
            $response = ILINX::view()->showWithDataNum($folderName, $searchDatums);
        } catch (IlinxException $exception) {
            $response = (object)[
                'Success'      => false,
                'ErrorMessage' => $exception->getMessage(),
            ];
        }

        $is_ICS_AppName = false;

        if ($response->Success == true) {
            $isSuccess = true;

            if (count($response->Data) > 0) {
                $titles = (array)$response->Data[0];
                if(!empty($titles['ICS_AppName'])){
                    $is_ICS_AppName = $titles['ICS_AppName'];
                }
                unset($titles['Ident'], $titles['ICS_DocumentID'], $titles['ICS_AppName'], $titles['ICS_FileExt']);
                $titles       = array_keys($titles);
                $folderDetail = json_decode(json_encode($response->Data), true);
            }
        }

        $error_message = $response->ErrorMessage;
        $currColNames = explode(', ', env('CURRENCY_COLUMN_NAMES'));

        //lowercase column names to get uniformity
        $currColNames = array_map('strtolower', $currColNames);
        $currSign = env('CURRENCY_SYMBOL');

        $returnHTML = view('folders.detail', compact('encodeFolderName', 'folderDetail', 'titles', 'currColNames', 'currSign','isSuccess', 'error_message'))
            ->render();

        return response()->json([
            "is_success" => true,
            "html"       => $returnHTML,
            "is_ICS_AppName" => $is_ICS_AppName
        ]);
    }

    public function clearSearchDatumsFilter()
    {
        Session::forget('folderName');
        Session::forget('SearchDatums_lastFilter');
    }

    private static function getViewDefinition($name)
    {
        try {
            $json = ILINX::view()->search($name);
        } catch (IlinxException $exception) {
            $json = (object)[
                'Success'      => false,
                'ErrorMessage' => $exception->getMessage(),
            ];
        }

        $searchData    = [];
        $requiredFlags = false;

        if ($json->Success != true) {
            return $json;
        }

        if (count($json->Data->SearchFields) > 0) {
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

    public static function fetchFolderList()
    {
        // Check the age of the FolderIndex object in the cache
        $folderObjCacheTime = Session::get('folderObjCacheTime');
        if (!empty($folderObjCacheTime)) {
            if (time() - $folderObjCacheTime < env('ILINX_CACHE_TIMEOUT')) {
                // Our cache is fresh, return the cached object
                $cachedFolderObj = Session::get('folderObj');
                if (!empty($cachedFolderObj)) {
                    return $cachedFolderObj;
                }
            }
        }

        try {
            $folderObj = ILINX::view()->setBaseUrl(config('ilinx.ics_url'))->index();
        } catch (IlinxException $exception) {
            $folderObj = (object)[
                'Success'      => false,
                'ErrorMessage' => $exception->getMessage(),
            ];
        }

        if (empty($folderObj)) {
            Utility::ILINXLog('ERROR folderIndex ILINX get-views error: EMPTY json results: ' . $folderObj);

            // Return some appropriate error to user here
            $err               = new \stdClass();
            $err->Success      = false;
            $err->ErrorMessage = __('An error occurred attempting to retrieve the list of views.');

            return $err;
        }
        if ($folderObj->Success != 'true') {
            // Return some appropriate error to user here
            Utility::ILINXLog('ERROR folderIndex ILINX get-views REST error: ' . $folderObj->ErrorMessage);

            $err               = new \stdClass();
            $err->Success      = false;
            $err->ErrorMessage = __('An error occurred attempting to retrieve the list of views.');

            return $err;
        }

        Utility::ILINXLog('DEBUG Folder List get-views success');

        // Update the batch docs into the cache and store the time
        Session::put('folderObjCacheTime', time());
        Session::put('folderObj', $folderObj);

        return $folderObj;
    }

    public function repoDetails($repositoryName,$docId,$type = 'add')
    {
        try {
            $response = ILINX::repositories()->setBaseUrl(config('ilinx.ics_url'))->index();
        } catch (IlinxException $exception) {
            $response = (object)[
                'Success'      => false,
                'ErrorMessage' => $exception->getMessage(),
            ];
        }

        if ($response->Success == true && gettype($response->Data) == 'array' && count($response->Data) > 0) {
            $key = array_search($repositoryName, array_column($response->Data, 'RepositoryName'));
            if(!empty($response->Data[$key])){
                $data = $response->Data[$key];
                try {
                    $response_details = ILINX::repositories()->setBaseUrl(config('ilinx.ics_url'))->show($data->RepositoryID,$data->RepositoryName);
                    if($response_details->Success == true && !empty($response_details->Data)){
                        $details = $response_details->Data;
                        if(!empty($details->UgPermission)){
                            if($type == 'add'){
                                if(!empty($details->UgPermission->CanCaptureDocuments) && $details->UgPermission->CanCaptureDocuments == true){

                                    $filetype = explode(', ',env('ALLOWED_UPLOAD_FILE_TYPES'));
                                    $filetype = implode(',.', $filetype);

                                    $defaultIcon = config('defaultIcon');

                                    return response()->json([
                                        'Success'      => true,
                                        'html' => view('folders.add_document', compact('details','repositoryName','filetype','defaultIcon'))->render(),
                                        'ErrorMessage' => __('You do not have permissions to add new documents to this repository.'),
                                    ]);
                                }else{

                                    return response()->json([
                                        'Success'      => false,
                                        'ErrorMessage' => __('You do not have permissions to add new documents to this repository.'),
                                    ]);
                                }
                            }elseif($type == 'update'){

                                $permission = $details->UgPermission->CanUpdateIndexValue;
                                $results = ILINX::docs()->setBaseUrl(config('ilinx.ics_url'))->showWithRepositoryName($repositoryName, $docId);

                                if ($results->Success) {
                                    $indexvalues    = !empty($results->Data->IndexValues) ? $results->Data->IndexValues : [];

                                    return response()->json([
                                        'Success'      => true,
                                        'html' => view('folders.update_document', compact('details','repositoryName','permission','docId','indexvalues'))->render(),
                                        'ErrorMessage' => '',
                                    ]);
                                } else {
                                    return response()->json([
                                        'Success'      => false,
                                        'ErrorMessage' => _('An error occurred retrieving details.') . '<br>' . __('Please contact your system administrator for assistance.'),
                                    ]);
                                }
                            }else{
                                return response()->json([
                                    'Success'      => false,
                                    'ErrorMessage' => __('Something went wrong.'),
                                ]);
                            }
                        }
                    }
                } catch (IlinxException $exception) {

                    return response()->json([
                        'Success'      => false,
                        'ErrorMessage' => $exception->getMessage(),
                    ]);
                }
            }
        }
    }

    // IRD Upload Document Store
    public function addNewDoc(Request $request,$repositoryName)
    {

        if($request->hasFile('file')){

            $data = [];
            foreach($request->input()['input'] as $key => $val){

                $fld = new \stdClass();

                // NOTE: these fields must be available in the Content Store IRD storage application!
                $fld->IndexName  = $key;
                $fld->IndexValue = $val;

                $data[] = $fld;
            }

            $rawindexes = json_encode($data);
            try{

                $filename = $request->file('file')->getClientOriginalName();

                // create the file receiver
                $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

                // check if the upload is success, throw exception or return response you need
                if ($receiver->isUploaded() === false) {
                    throw new UploadMissingFileException();
                }

                // receive the file
                $save = $receiver->receive();

                // check if the upload has finished (in chunk mode it will send smaller files)
                if ($save->isFinished()) {
                    $filepath = $save->getFile()->getPathName();
                    $filemime   = $save->getFile()->getMimeType();

                    $usrData = Session::get('userInfo');
                    $url      = config('ilinx.ics_url') . 'create-doc';
                    $boundary = "---------------------" . md5(mt_rand() . microtime());

                    $body   = [];
                    $body[] = implode("\r\n", [
                        $boundary,
                        "Content-Disposition: form-data; name=\"username\"",
                        "",
                        $usrData->Username,
                    ]);

                    $body[] = implode("\r\n", [
                        $boundary,
                        "Content-Disposition: form-data; name=\"securityToken\"",
                        "",
                        $usrData->SecurityToken,
                    ]);

                    $body[] = implode("\r\n", [
                        $boundary,
                        "Content-Disposition: form-data; name=\"repositoryName\"",
                        "",
                        $repositoryName,
                    ]);
                    $body[] = implode("\r\n", [
                        $boundary,
                        "Content-Disposition: form-data; name=\"indexInfoJson\"",
                        "",
                        $rawindexes,
                    ]);

                    $data   = file_get_contents($filepath);
                    $body[] = implode("\r\n", [
                        $boundary,
                        "Content-Disposition: form-data; name=\"" . $filename . "\"; filename=\"" . $filename . "\";",
                        "Content-Type: " . $filemime,
                        "",
                        $data,
                    ]);

                    $body[] = $boundary;

                    $curl    = curl_init();
                    $options = [
                        CURLOPT_URL            => $url,
                        CURLOPT_POST           => 1,
                        CURLOPT_POSTFIELDS     => implode("\r\n", $body),
                        CURLOPT_RETURNTRANSFER => true,
                    ];

                    curl_setopt_array($curl, $options);

                    $response = curl_exec($curl);

                    Utility::ILINXLog("response: " . print_r($response, true));

                    $err = curl_error($curl);
                    curl_close($curl);

                    if ($err) {
                        Utility::ILINXLog("cURL Error #:" . $err);

                         return response()->json([
                            "done" => 0,
                            "status" => false,
                            "is_success" => false,
                            "message" =>  __('Something went wrong.'),
                        ]);
                    }


                    return response()->json([
                        "done" => $save->handler()->getPercentageDone(),
                        "status" => true,
                        "is_success" => true,
                        "message" =>  __('File uploaded successfully.')
                    ]);
                }

                // we are in chunk mode, lets send the current progress
                /** @var AbstractHandler $handler */
                $handler = $save->handler();

                return response()->json([
                    "done" => $handler->getPercentageDone(),
                    "status" => true,
                    "is_success" => true,
                    "message" =>  __('File uploaded successfully.')
                ]);
            }catch(\Exception $e){

                return response()->json([
                    "done" => 0,
                    "status" => false,
                    "is_success" => false,
                    "message" =>  __('Something went wrong.'),
                ]);
            }
        }
    }

    public function addOpenDocPropsToSession($docID){

        // Commented out. This is the old version of setting property sessions on documents

        // $openDocProps = session()->get('openDocProperties') ? session()->get('openDocProperties') : [];
        // $exist = in_array($docID, $openDocProps);
        // if (!$exist){
        //     $openDocProps[] = $docID;
        //     session()->put('openDocProperties', $openDocProps);

        //     return response()->json([
        //         'Success'      => true,
        //         'docID' => $docID,
        //         'message' => $docID .' : added in session OpenDocProperties'
        //     ]);
        // }

        // !-- End --!

        $newOpenDocProps = session()->get('newDocProperties') ? session()->get('newDocProperties') : NULL;
        if (!isset($newOpenDocProps)) {
            session()->put('newDocProperties', "true");

            return response()->json([
                'Success'      => true,
                'docID' => $docID,
                'message' => 'Properties panel is opened'
            ]);
        }

        return response()->json([
            'Success'      => false,
            'docID' => $docID,
            // 'message' => $docID .' : already exist in session OpenDocProperties'
            'message' => 'newDocProperties is already set to true'
        ]);
    }

    public function removeOpenDocPropsToSession($docID)
    {
        // Commented out. This is the old version of setting property sessions on documents

        // $openDocsProps = session()->get('openDocProperties');
        // $key = array_search($docID, $openDocsProps);
        // if ($key !== false) {
        //     unset($openDocsProps[$key]);
        //     session()->put('openDocProperties', $openDocsProps);
        //     return response()->json([
        //         'Success'      => true,
        //         '$openDocsProps' => $openDocsProps,
        //         'docID' => $docID,
        //         'message' => $docID .' : remove from session OpenDocProperties'
        //     ]);
        // }

        // !-- End --!

        $newOpenDocProps = session()->get('newDocProperties');
        if (isset($newOpenDocProps)) {
            session()->forget('newDocProperties');

            return response()->json([
                'Success'      => true,
                'docID' => $docID,
                'message' => 'Properties panel is closed'
            ]);
        }

        return response()->json([
            'Success'      => false,
            'docID' => $docID,
            'message' => 'newDocProperties is already set to false'
        ]);
    }

    // Update document
    public function updateDocProprties(Request $request,$repositoryName,$DocId)
    {
        //dd($request->input()['input']);
        $data = [];
        $indexvalues = $request->indexvalues;
        if(!empty($indexvalues)){
            $indexvalues = json_decode($indexvalues);
            if(!empty($indexvalues) && count($indexvalues)>0){
                $column = array_column($indexvalues, 'IndexName');
            }
        }
        foreach($request->input()['input'] as $key => $val){
            if(!empty($column) && count($column)>0){
                $found_key = array_search($indexVal->FieldName, $column);
                $input_value = $indexvalues[$found_key]->IndexValue;
            }else{
                $input_value = '';
            }
            if($val != $input_value){
                $fld = new \stdClass();

                // NOTE: these fields must be available in the Content Store IRD storage application!
                $fld->IndexName  = $key;
                $fld->IndexValue = $val;

                $data[] = $fld;
            }
        }

        if(count($data)>0){
            $rawindexes = json_encode($data);
            try {
                $response_details = ILINX::docs()->setBaseUrl(config('ilinx.ics_url'))->updateArrayIndexes($repositoryName, $data, $DocId);

                if($response_details->Success){
                    return response()->json([
                        'Success'      => true,
                        'Message' => __('Document updated successfully.'),
                    ]);
                    //return redirect()->back()->with('success', __('Document updated successfully.'));
                }else{
                    //return redirect()->back()->with('error', $response_details->ErrorMessage);
                    return response()->json([
                        'Success'      => false,
                        'ErrorMessage' => $response_details->ErrorMessage,
                    ]);
                }
            }catch(\Exception $e){
                //return redirect()->back()->with('error', __('Something went wrong.'));
                return response()->json([
                    'Success'      => false,
                    'ErrorMessage' => __('Something went wrong.'),
                ]);
            }
        }else{
            return response()->json([
                'Success'      => false,
                'ErrorMessage' => __('Nothing to update.'),
            ]);
            //return redirect()->back()->with('error', __('Nothing to update.'));
        }
    }
}
