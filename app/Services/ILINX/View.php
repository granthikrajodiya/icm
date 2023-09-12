<?php

namespace App\Services\ILINX;

use App\Services\ILINX\Core\Client;
use Exception;

class View extends Client
{
    /**
     * @throws Exception
     */
    public function index(): object
    {
        return $this->get('get-views');
    }

    /**
     * @throws Exception
     */
    public function search(string $name): object
    {
        $this->setBaseUrl(config('ilinx.ics_url'));

        return $this->get('ird-get-view-definition', [
            'viewName' => $name,
        ]);
    }

    public function searchWorkflowView(string $name): object
    {
        $this->setBaseUrl(config('ilinx.ic_url'));

        return $this->get('ird-get-view-definition', [
            'viewName' => $name,
        ]);
    }

    public function show(string  $viewName, ?string $fieldName = null, ?string $fieldValue = null, bool $useMaxCount = false): object
    {
        $userInfo = session('userInfo');
        $data     = [
            'UserName'      => $userInfo->Username,
            'SecurityToken' => $userInfo->SecurityToken,
            'ViewName'      => $viewName,
            // Every call to execute-view MUST pass in the current tenant_id as a search parameter for security filtering
            'SearchDatums'  => $this->getSearchDatums($fieldName, $fieldValue),
        ];

        if ($useMaxCount) {
            $data['UseMaxCount'] = true;
        }

        return $this->post('execute-view2', $data);
    }

    public function showWithDataNum(string $viewName, ?array $searchDatums = [], bool $useMaxCount = false): object
    {
        $userInfo = session('userInfo');
        $data     = [
            'UserName'      => $userInfo->Username,
            'SecurityToken' => $userInfo->SecurityToken,
            'ViewName'      => $viewName,
            'SearchDatums'  => $searchDatums,
        ];

        if ($useMaxCount) {
            $data['UseMaxCount'] = true;
        }

        // Every call to execute-view MUST pass in the current tenant_id as a search parameter for security filtering
        if(empty($searchDatums) || count($searchDatums) == 0) {
            $data['SearchDatums'] = $this->getSearchDatums();
        } else {
            // Add the tenant_id parameter if not found in the provided search datum
            $found = false;
            foreach($searchDatums as $datum)
            {
                if (is_array($datum)) {
                    $fieldName = $datum['FieldName'];
                } else {
                    $fieldName = $datum->FieldName;
                }
                if($fieldName == 'TenantId') {
                    $found = true;
                    break;
                }
            }
            if($found == false) {
                $tenantArr = $this->getSearchDatums();
                $data['SearchDatums'][] = $tenantArr[0];
            }
        }

        return $this->post('execute-view2', $data);
    }

    public function getICSViewsWithoutDataOnlyView(): object
    {
        return $this->get('ird-get-views-without-data-only-view');
    }

    private function getSearchDatums(?string $fieldName = null, ?string $fieldValue = null): array
    {
        $searchDatums = [
            [
                'AvailableSearchOperators' => [0],
                'DataAction'               => 0,
                'DecimalPrecision'         => 2147483647,
                'DecimalScale'             => 2147483647,
                'DefaultValue'             => '',
                'DisplayName'              => '',
                'FieldType'                => 0,
                'HasLookup'                => false,
                'Hidden'                   => false,
                'IncludeTimeInDateField'   => false,
                'IsLinked'                 => false,
                'IsRestricted'             => false,
                'IsSystemField'            => false,
                'LinkedTableAlias'         => '',
                'LookupInfoXml'            => '',
                'MaxFieldLength'           => 2147483647,
                'MaxLines'                 => 2147483647,
                'PickListFieldValues'      => '',
                'Readonly'                 => false,
                'Required'                 => true,
                'TablePrefix'              => '',
                'FieldName'                => 'TenantId',
                'SearchOperator'           => 0,
                'FieldValue'               => user()->tenant_id
            ],
        ];

        if ($fieldName && $fieldValue) {
            $search               = $searchDatums[0];
            $search['FieldName']  = $fieldName;
            $search['FieldValue'] = $fieldValue;
            array_unshift($searchDatums, $search);
        }

        return json_decode(json_encode($searchDatums), false);
    }

    public function getViewSearchField($viewId)
    {
        return $this->get('ird-get-view-search-fields', ['viewId' => $viewId])->Data;
    }
}
