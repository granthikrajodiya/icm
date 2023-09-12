<?php

namespace App\Services\ILINX;

use App\Services\ILINX\Core\Client;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Batch extends Client
{
    /**
     * @throws Exception
     */
    public function show(string|int $batchId): object
    {
        return $this->get('get-batch-details', [
            "batchID" => $batchId,
        ]);
    }

    /**
     * @throws Exception
     */
    public function history(string|int $batchId): object
    {
        return $this->get('get-batch-history', [
            "batchID" => $batchId,
        ]);
    }

    /**
     * IRD Functions
     */

    public function irdAddSearchKey(string|int $batchId, string $searchData): object
    {
        $userInfo = Session::get('userInfo');

        return $this->post('add-search-keys', [
            "UserName"      => $userInfo->Username ?? "",
            "SecurityToken" => $userInfo->SecurityToken ?? "",
            "BatchID"       => $batchId,
            "SearchData"    => [$searchData]
        ]);
    }

    public function irdDeleteSearchKeys(string|int $batchId, string $searchDataJson): object
    {
        $userInfo = Session::get('userInfo');
        $searchData = json_decode($searchDataJson);

        return $this->post('remove-search-keys', [
            "UserName"      => $userInfo->Username ?? "",
            "SecurityToken" => $userInfo->SecurityToken ?? "",
            "BatchID"       => $batchId,
            "SearchData"    => $searchData
        ]);
    }

    public function irdGetSearchKey(string|int $batchId)
    {
        return $this->get('get-search-keys', [
            'batchID' => $batchId
        ]);
    }

    public function irdSubmitRequest(string|int $batchId): object
    {
        return $this->get('submit-batch', [
            'batchID' => $batchId,
        ]);
    }

    public function irdRejectRequest(string|int $batchId, string $rejectionNote, string $reasonCategory): object
    {
        return $this->get('reject-batch', [
            'batchID'        => $batchId,
            'rejectionNote'  => $rejectionNote,
            'reasonCategory' => $reasonCategory
        ]);
    }

    public function irdLockRequest(string|int $batchId): object {
        $userInfo = Session::get('userInfo');
        $url = config('ilinx.ic_url') . 'ird-lock-request?batchID=' . $batchId;

        $response = Http::withHeaders([
            'Username'      => $userInfo->Username,
            'SecurityToken' => $userInfo->SecurityToken,
            'ActivationKey' => config('ilinx.activation_id')
        ])->post($url);

        if ($response->failed() && $response->getReasonPhrase() === 'Security token has expired.') {
            return redirect()->route('logout', [tenant('tenant_id')])->send();
        }

        return $response;
    }

    public function irdUnlockRequest(string|int $batchId): object {
        $userInfo = Session::get('userInfo');
        $url = config('ilinx.ic_url') . 'ird-unlock-request?batchID=' . $batchId;

        $response = Http::withHeaders([
            'Username'      => $userInfo->Username,
            'SecurityToken' => $userInfo->SecurityToken,
            'ActivationKey' => config('ilinx.activation_id')
        ])->post($url);

        if ($response->failed() && $response->getReasonPhrase() === 'Security token has expired.') {
            return redirect()->route('logout', [tenant('tenant_id')])->send();
        }

        return $response;
    }

    public function irdShowWithGuid(string $guid): object
    {
        return $this->get('ird-get-request-info', [
            "uniqueID" => $guid,
        ],
            [
                "ActivationKey" => config('ilinx.activation_id')
            ]);
    }

    public function irdGetRequestNewDocID(string|int $batchId): object
    {
        $userInfo = Session::get('userInfo');

        return $this->post('ird-add-unique-id', [
            "UserName"      => $userInfo->Username ?? "",
            "SecurityToken" => $userInfo->SecurityToken ?? "",
            "BatchID"       => $batchId,
            "ActivationKey" => config('ilinx.activation_id')
        ]);
    }

    public function irdDeleteRequestNewDocID(string|int $batchId, string $uniqueID): object
    {
        $userInfo = Session::get('userInfo');

        return $this->post('ird-remove-unique-id', [
            "UserName"      => $userInfo->Username ?? "",
            "SecurityToken" => $userInfo->SecurityToken ?? "",
            "BatchID"       => $batchId,
            "UniqueID"      => $uniqueID,
            "ActivationKey" => config('ilinx.activation_id')
        ]);
    }

    public function irdRemoveMappingGuidAndRequestID(string $batchId, string $guid): object
    {
        $userInfo = Session::get('userInfo');

        return $this->post('ird-remove-unique-id', [
            "UserName"      => $userInfo->Username ?? "",
            "SecurityToken" => $userInfo->SecurityToken ?? "",
            "BatchID"       => $batchId,
            "UniqueID"      => $guid,
            "ActivationKey" => config('ilinx.activation_id')
        ]);
    }

    public function irdUpdateSingleField(string|int $batchId, string $dataType, string $indexId, string $indexName, string $indexValue): object
    {
        $userInfo = Session::get('userInfo');

        $indexField = new \stdClass();
        $indexField->DataType = $dataType;
        $indexField->IndexID = $indexId;
        $indexField->IndexName = $indexName;
        $indexField->IndexValue = $indexValue;

        return $this->put('update-batch',[
            "UserName"      => $userInfo->Username ?? "",
            "SecurityToken" => $userInfo->SecurityToken ?? "",
            "BatchID"       => $batchId,
            "IndexValues"   => [$indexField],
        ]);
    }

    public function getProfileIdByName($batchProfileName)
    {
        return $this->get('ird-get-profileid', [
            'name' => $batchProfileName
        ]);
    }
}
