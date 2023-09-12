<?php

namespace App\Services\ILINX;

use App\Services\ILINX\Core\Client;
use Exception;

class Form extends Client
{
    public function __construct()
    {
        $this->setBaseUrl(config('ilinx.flex_api_url'));

        parent::__construct();
    }

    /**
     * @throws Exception
     */
    public function index(): object
    {
		$json = $this->get('secured/eforms');
		// If we have results, sort them by name
		if (!empty($json) && $json->Success == 'true')
		{
            $json->Data = collect($json->Data)->sortBy('Name', SORT_NATURAL, false);
		}

        return $json;
    }

    /**
     * @throws Exception
     */
    public function link(string|int $batchId): object
    {
        return $this->get('get-batch-link/' . $batchId);
    }

     /**
     * @throws Exception
     */
    public function dashboards(): object
    {
        return $this->get('secured/dashboards');
    }

}
