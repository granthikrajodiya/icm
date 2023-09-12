<?php

namespace App\Http\Controllers;

use App\Facades\ILINX;
use App\Models\Layout;
use App\Models\Note;
use App\Models\Utility;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

/**
 * @SuppressWarnings(PHPMD)
 */
class CourtCasesPresentationController extends Controller
{
    public function index($taskName, $viewId = '')
    {
        $response   = TaskController::fetchTaskDetail($taskName);
        $taskDetail = [];
        $titles     = [];
        $isSuccess  = false;

        if ($response->Success == true) {
            $isSuccess = true;

            if (count($response->Data) > 0) {
                $titles     = (array)$response->Data[0];
                $titles     = array_keys($titles);
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

        $layout = Layout::where('id', $viewId)->first();

        $eformUrl = '';

        if (!is_null($layout)) {
            $eformUrl = $layout->eform_url;
        }

        return view('courtcase.list', compact('taskName', 'taskDetail', 'titles', 'viewId', 'isSuccess', 'eformUrl'));
    }

    public function courtcasesDetails($case, $batchId)
    {
        $usrData = Session::get('userInfo');

        $response = ILINX::batch()->setBaseUrl(config('ilinx.ic_url'))->show($batchId);
        $data     = $response->Data;

        $arrHeader          = [];
        $arrNonSystemHeader = [];

        $arrNonSystemHeader['Batch ID']           = $data->BatchID;
        $arrNonSystemHeader['Batch Profile Name'] = $data->BatchProfileName;

        foreach ($data->IndexValues as $val) {
            if (\Str::contains($val->IndexName, ['[', ']', ]) != true) {
                $arrHeader[$val->IndexName] = $val->IndexValue;
            } else {
                $arrNonSystemHeader[str_replace(['[', ']', ], ['', '', ], $val->IndexName)] = $val->IndexValue;
            }
        }

        $arrHeader['Board']                       = $arrHeader['Board']                       ?? '';
        $arrHeader['Case Number']                 = $arrHeader['Case Number']                 ?? '';
        $arrHeader['Status']                      = $arrHeader['Status']                      ?? '';
        $arrHeader['Date Filed']                  = $arrHeader['Date Filed']                  ?? '';
        $arrHeader['Case Name']                   = $arrHeader['Case Name']                   ?? '';
        $arrHeader['Reason Appealed']             = $arrHeader['Reason Appealed']             ?? '';
        $arrHeader['County']                      = $arrHeader['County']                      ?? '';
        $arrHeader['City']                        = $arrHeader['City']                        ?? '';
        $arrHeader['Dispositive Motion Deadline'] = $arrHeader['Dispositive Motion Deadline'] ?? '';
        $arrHeader['Closing Briefs Filed']        = $arrHeader['Closing Briefs Filed']        ?? '';
        $arrHeader['Archive Reference']           = $arrHeader['Archive Reference']           ?? '';
        $arrHeader['Master']                      = $arrHeader['Master']                      ?? '';
        $arrHeader['Mediation Status']            = $arrHeader['Mediation Status']            ?? '';
        $arrHeader['Date Closed']                 = $arrHeader['Date Closed']                 ?? '';
        $arrHeader['Reconsideration Granted']     = $arrHeader['Reconsideration Granted']     ?? '';
        $arrHeader['Appealed to Superior Court']  = $arrHeader['Appealed to Superior Court']  ?? '';
        $arrHeader['Presiding Officer']           = $arrHeader['Presiding Officer']           ?? '';

        // If no non-system index value found then
        if (count($arrHeader) == 0) {
            foreach ($data->IndexValues as $val) {
                if ($val->IndexName == '[Batch name]' || $val->IndexName == '[Date created]') {
                    $arrHeader[str_replace(['[', ']', ], ['', '', ], $val->IndexName)] = $val->IndexValue;
                }
            }
        }

        session_start();
        header('Content-Type: text/html; charset=utf-8');

        $docuViewareConfig = [
            'SessionId'                        => session_id(),
            'ControlId'                        => 'DocuVieware1',
            'AllowPrint'                       => true,
            'EnablePrintButton'                => true,
            'AllowUpload'                      => true,
            'EnableFileUploadButton'           => true,
            'CollapsedSnapIn'                  => true,
            'ShowAnnotationsSnapIn'            => true,
            'EnableRotateButtons'              => true,
            'EnableZoomButtons'                => true,
            'EnablePageViewButtons'            => true,
            'EnableMultipleThumbnailSelection' => true,
            'EnableMouseModeButtons'           => true,
            'EnableFormFieldsEdition'          => true,
            'EnableTwainAcquisitionButton'     => false,
            'Locale'                           => substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2),
        ];

        $dataString = json_encode($docuViewareConfig);
        $ch         = curl_init('http://ilinxblue.cloudapp.net/DocuViewareREST/api/DocuViewareREST/GetDocuViewareControl');

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($dataString),
        ]);

        if (($result = curl_exec($ch)) === false) {
            curl_close($ch);

            return null;
        }

        curl_close($ch);
        $docuViewareControlHtml = json_decode($result);

        return view('courtcase.detail', compact('case', 'response', 'arrHeader', 'batchId', 'usrData', 'docuViewareControlHtml'));
    }

    public function courtcasesHistoryView($caseNumber, $batchId)
    {
        // Users Notes
        $userNotes = Note::where('batch_id', 'LIKE', $batchId)->get();
        $errorMsg  = '';

        // Check the age of the caseBatch object in the cache
        $caseBatchHistoryTime = Session::get('caseBatchHistoryTime');

        if (!empty($caseBatchHistoryTime)) {
            if (time() - $caseBatchHistoryTime < env('ILINX_CACHE_TIMEOUT')) {
                // Our cache is fresh, return the cached object
                $caseBatchHistoryObj = Session::get('caseBatchHistoryObj');
                if (!empty($caseBatchHistoryObj)) {
                    $historyBatch = $caseBatchHistoryObj;

                    return view('ird.ird_history', compact('userNotes', 'batchId', 'historyBatch', 'errorMsg'));
                }
            }
        }

        $historyBatch = ILINX::batch()->setBaseUrl(config('ilinx.ic_url'))->history($batchId);

        if (!empty($historyBatch)) {
            if ($historyBatch->Success == true) {
                $historyBatch = $historyBatch->Data;

                foreach ($historyBatch as $key => $history) {
                    $removeChar                     = str_replace(str_split('/()Date'), '', $history->CreateDate);
                    $historyBatch[$key]->CreateDate = date(Utility::getValByName('date_format'), substr(explode('-', $removeChar)[0], 0, -3));
                }

                // Update the primary caseBatchHistoryObj into the cache and store the time
                Session::put('caseBatchHistoryTime', time());
                Session::put('caseBatchHistoryObj', $historyBatch);
            } else {
                Utility::ILINXLog('courtcaseHistoryView ILINX error: ' . $historyBatch->ErrorMessage);
            }
        }

        return view('courtcase.history', compact('userNotes', 'batchId', 'historyBatch', 'errorMsg'));
    }

    public function addCaseNote($id, Request $request)
    {
        $note = Note::where('created_by', '=', user()->id)->where('batch_id', 'LIKE', $id)->first();
        if (empty($note)) {
            $note = Note::create([
                'batch_id'   => $id,
                'notes'      => $request->notes,
                'created_by' => user()->id,
            ]);
            $note->status = "create";
        } else {
            $note->notes = $request->notes;
            $note->save();
            $note->status = "update";
        }
        $note->createdBy = $note->createdBy->name;
        $note->date      = Utility::getDateFormatted($note->created_at);

        return response()->json(
            [
                'is_success' => true,
                'success'    => true,
                'data'       => $note,
                'message'    => __('Note successfully saved!'),
            ],
            200
        );
    }
}
