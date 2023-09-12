<?php

namespace App\Services\ILINX;

use App\Services\ILINX\Core\Client;
use Exception;
use Illuminate\Support\Facades\Session;

class Docs extends Client
{
    /**
     * @throws Exception
     */
    public function index(string | int $batchId): object
    {
        return $this->get('get-batch-docs', [
            "batchID" => $batchId,
        ]);
    }

    public function show(string | int $batchId, string | int $docId): object
    {
        return $this->get('get-doc-details', [
            "batchID" => $batchId,
            "docID"   => $docId,
        ]);
    }

    public function showWithRepositoryName(string | int $repositoryName, string | int $docId): object
    {
        return $this->get('get-doc-details', [
            "repositoryName" => $repositoryName,
            "docID"          => $docId,
        ]);
    }

    public function update(string $repoName, array $indexVal, string | int $docID): object
    {
        $userInfo = Session::get('userInfo');

        return $this->put('update-doc', [
            "UserName"       => $userInfo->Username ?? "",
            "SecurityToken"  => $userInfo->SecurityToken ?? "",
            "DocID"          => $docID,
            "RepositoryName" => $repoName,
            "IndexValues"    => [$indexVal]
        ]);
    }

    public function updateArrayIndexes(string $repoName, array $indexVal, string | int $docID): object
    {
        $userInfo = Session::get('userInfo');

        return $this->put('update-doc', [
            "UserName"       => $userInfo->Username ?? "",
            "SecurityToken"  => $userInfo->SecurityToken ?? "",
            "DocID"          => $docID,
            "RepositoryName" => $repoName,
            "IndexValues"    => $indexVal
        ]);
    }

    public function updateAnnotations(string $repoName, string $annotationJson, string | int $docID): object
    {
        $userInfo = Session::get('userInfo');

        return $this->put('update-doc-annotations', [
            "UserName"       => $userInfo->Username ?? "",
            "SecurityToken"  => $userInfo->SecurityToken ?? "",
            "DocID"          => $docID,
            "RepositoryName" => $repoName,
            "AnnotationJson" => $annotationJson
        ]);
    }

    public function submit(string $repoName, array $indexVal, string $annotationJson, string | int $docID): object
    {
        $userInfo = Session::get('userInfo');

        return $this->put('update-doc-with-annotations', [
            "UserName"       => $userInfo->Username ?? "",
            "SecurityToken"  => $userInfo->SecurityToken ?? "",
            "DocID"          => $docID,
            "RepositoryName" => $repoName,
            "IndexValues"    => [$indexVal],
            "AnnotationJson" => $annotationJson
        ]);
    }

    public function release(string $repositoryName, string $releaseRepositoryName, string | int $docId, string $indexesJson, string $releaseIndexInfoJson, string $releaseAnnotationJson): object
    {
        $userInfo = Session::get('userInfo');

        return $this->post('update-burned-doc', [
            "UserName"              => $userInfo->Username ?? "",
            "SecurityToken"         => $userInfo->SecurityToken ?? "",
            "RepositoryName"        => $repositoryName,
            "ReleaseRepositoryName" => $releaseRepositoryName,
            "DocId"                 => $docId,
            "IndexesJson"           => $indexesJson,
            "ReleaseIndexInfoJson"  => $releaseIndexInfoJson,
            "ReleaseAnnotationJson" => $releaseAnnotationJson
        ]);
    }

    public function getAnnotations($repositoryNameIRD, $docId)
    {
        return $this->get('get-doc-details-with-annotations', [
            "repositoryName" => $repositoryNameIRD,
            "docID" => $docId
        ]);
    }

    public function getFilesByHash($fileHash)
    {
        return $this->get('ird-get-files-by-hash', [
            "fileHash" => $fileHash
        ]);
    }

    public function getHashFileFromDocview($viewName, $docId)
    {
        return $this->get('ird-get-hash-file-from-docview', [
            "viewName" => $viewName,
            "docId" => $docId
        ]);
    }

    public function copyDoc($repositoryName, $repositoryNameIRD, $docId, $indexesJson, $isRepositoryView)
    {
        $userInfo = Session::get('userInfo');

        return $this->post('ird-copy-doc', [
            "UserName"              => $userInfo->Username ?? "",
            "SecurityToken"         => $userInfo->SecurityToken ?? "",
            "RepositoryName"        => $repositoryName,
            "RepositoryNameIRD"     => $repositoryNameIRD,
            "DocID"                 => $docId,
            "IndexesJson"           => $indexesJson,
            "IsRepositoryView"      => $isRepositoryView
        ]);
    }

    public function getExistCurrentRequest($fileHash, $requestNumber, $batchId)
    {
        $searchDatums = $this->getSearchDatums($fileHash, $requestNumber, $batchId, true);
        return $this->ExecuteICSView(env('IRD_EXIST_IN_CURRENT_REQUEST'), false, false, $searchDatums);
    }

    public function getExistUploadCurrentRequest($fileHash, $requestNumber, $batchId)
    {
        $searchDatums = $this->getSearchDatums($fileHash, $requestNumber, $batchId, true);
        return $this->ExecuteICSView(env('IRD_EXIST_IN_UPLOAD_CURRENT_REQUEST'), false, false, $searchDatums);
    }

    public function getExistOtherRequests($fileHash, $requestNumber, $batchId)
    {
        $searchDatums = $this->getSearchDatums($fileHash, $requestNumber, $batchId, false);
        return $this->ExecuteICSView(env('IRD_EXIST_IN_OTHER_REQUESTS'), false, false, $searchDatums);
    }

    public function getExistUploadOtherRequests($fileHash, $requestNumber, $batchId)
    {
        $searchDatums = $this->getSearchDatums($fileHash, $requestNumber, $batchId, false);
        return $this->ExecuteICSView(env('IRD_EXIST_IN_UPLOAD_OTHER_REQUESTS'), false, false, $searchDatums);
    }

    public function getExistReleasedOtherRequests($fileHash, $requestNumber, $batchId)
    {
        $searchDatums = $this->getSearchDatums($fileHash, $requestNumber, $batchId, false);
        return $this->ExecuteICSView(env('IRD_EXIST_IN_RELEASED_OTHER_REQUESTS'), false, false, $searchDatums);
    }

    public function ExecuteICSView(string $viewName, bool $getFirstDocId, bool $useMaxCount, array $searchDatums): object
    {
        $userInfo = Session::get('userInfo');

        return $this->setBaseUrl(config('ilinx.ics_url'))->post('execute-view2', [
            "UserName"      => $userInfo->Username ?? "",
            "SecurityToken" => $userInfo->SecurityToken ?? "",
            "ViewName"      => $viewName,
            "GetFirstDocId" => $getFirstDocId,
            "UseMaxCount"   => $useMaxCount,
            "SearchDatums"  => $searchDatums
        ]);
    }

    private function getSearchDatums($fileHash, $requestNumber, $batchId, $inCurrentRequest)
    {
        /** operator: Refer at App\Models\Utility::VIEW_SEARCH_FIELD_OPERATORS
         *  - 0: Equal
         *  - 8: Not Equal
         */
        $operator = $inCurrentRequest ? 0 : 8;

        return [
            [
                "FieldName"      => 'FileHash',
                "FieldValue"     => $fileHash,
                "SearchOperator" => 0
            ],
            [
                "FieldName"      => "RequestNumber",
                "FieldValue"     => $requestNumber,
                "SearchOperator" => $operator
            ],
            [
                "FieldName"      => "BatchID",
                "FieldValue"     => $batchId,
                "SearchOperator" => $operator
            ]
        ];
    }
}
