<?php

namespace App\Services;

use App\Services\ILINX\Auth;
use App\Services\ILINX\Batch;
use App\Services\ILINX\Core\Client;
use App\Services\ILINX\Docs;
use App\Services\ILINX\Form;
use App\Services\ILINX\SecurityGroup;
use App\Services\ILINX\User;
use App\Services\ILINX\View;
use App\Services\ILINX\Repo;
use Illuminate\Support\Facades\App;

class ILINX
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function auth(): Auth
    {
        return App::make(Auth::class);
    }

    public function batch(): Batch
    {
        return App::make(Batch::class);
    }

    public function docs(): Docs
    {
        return App::make(Docs::class);
    }

    public function form(): Form
    {
        return App::make(Form::class);
    }

    public function user(): User
    {
        return App::make(User::class);
    }

    public function view(): View
    {
        return App::make(View::class);
    }

    public function securityGroup(): SecurityGroup
    {
        return App::make(SecurityGroup::class);
    }

    public function file(string $url): string
    {
        return $this->client->stream($url);
    }

    public function repositories(): Repo
    {
        return App::make(Repo::class);
    }
}
