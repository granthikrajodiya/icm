<?php

namespace App\Services\ILINX;

use App\Services\ILINX\Core\Client;
use Exception;

class Repo extends Client
{
    /**
     * @throws Exception
     */
    public function index(): object
    {
        return $this->get('get-repositories');
    }

    public function show(string | int $repositoryId, string $repositoryName): object
    {
        return $this->get('get-repository', [
            "repositoryId" => $repositoryId,
            "repositoryName"   => $repositoryName,
        ]);
    }
}
