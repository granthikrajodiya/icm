<?php

namespace App\Providers;

use App\Services\ILINX\Auth;
use App\Services\ILINX\Batch;
use App\Services\ILINX\Docs;
use App\Services\ILINX\Form;
use App\Services\ILINX\SecurityGroup;
use App\Services\ILINX\User;
use App\Services\ILINX\View;
use App\Services\ILINX\Repo;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use RuntimeException;

class IlinxServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Auth::class, function (Application $app): Auth {
            if ($app->runningUnitTests()) {
                throw new RuntimeException('The App\Services\ILINX\Auth class should be mocked on tests.');
            }

            return new Auth;
        });

        $this->app->bind(Batch::class, function (Application $app): Batch {
            if ($app->runningUnitTests()) {
                throw new RuntimeException('The App\Services\ILINX\Batch class should be mocked on tests.');
            }

            return new Batch;
        });

        $this->app->bind(Docs::class, function (Application $app): Docs {
            if ($app->runningUnitTests()) {
                throw new RuntimeException('The App\Services\ILINX\Docs class should be mocked on tests.');
            }

            return new Docs;
        });

        $this->app->bind(Form::class, function (Application $app): Form {
            if ($app->runningUnitTests()) {
                throw new RuntimeException('The App\Services\ILINX\Form class should be mocked on tests.');
            }

            return new Form;
        });

        $this->app->bind(User::class, function (Application $app): User {
            if ($app->runningUnitTests()) {
                throw new RuntimeException('The App\Services\ILINX\User class should be mocked on tests.');
            }

            return new User;
        });

        $this->app->bind(View::class, function (Application $app): View {
            if ($app->runningUnitTests()) {
                throw new RuntimeException('The App\Services\ILINX\View class should be mocked on tests.');
            }

            return new View;
        });

        $this->app->bind(SecurityGroup::class, function (Application $app): SecurityGroup {
            if ($app->runningUnitTests()) {
                throw new RuntimeException('The App\Services\ILINX\SecurityGroup class should be mocked on tests.');
            }

            return new SecurityGroup;
        });

        $this->app->bind(Repo::class, function (Application $app): Repo {
            if ($app->runningUnitTests()) {
                throw new RuntimeException('The App\Services\ILINX\Repo class should be mocked on tests.');
            }

            return new Repo;
        });
    }
}
