<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (!$this->app->isProduction()) {
            $this->app->register(LaravelLogViewerServiceProvider::class);
        } else {
            $this->app['request']->server->set('HTTPS','on');
            URL::forceScheme('https');
        }
    }

    public function boot()
    {
    }
}
