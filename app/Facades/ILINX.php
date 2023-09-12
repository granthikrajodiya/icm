<?php

namespace App\Facades;

use App\Services\ILINX as Action;
use App\Services\ILINX\Auth;
use App\Services\ILINX\Batch;
use App\Services\ILINX\Docs;
use App\Services\ILINX\Form;
use App\Services\ILINX\User;
use App\Services\ILINX\View;
use App\Services\ILINX\Repo;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Auth auth()
 * @method static Batch batch()
 * @method static Docs docs()
 * @method static Form form()
 * @method static User user()
 * @method static View view()
 * @method static SecurityGroup securityGroup()
 * @method static string file(string $url)
 */
class ILINX extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Action::class;
    }
}
