<?php

namespace App\Services\ILINX;

use App\Services\ILINX\Core\Client;

class SecurityGroup extends Client
{
    public function index(): object
    {
        return $this->get('get-builtin-groups');
    }

    public function externalGroup(): object
    {
        return $this->get('get-external-groups');
    }
}
