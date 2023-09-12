<?php

namespace Engage\Downloadcenter;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class DownloadcenterServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'engage_downloadcenter');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->setPublishes();
        $this->registerCommands();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/package-layout.php', 'package-layout'
        );
    }

    /**
     * Publishing the files that the user may override.
     *
     * @return void
     */
    protected function setPublishes()
    {
    }

    /**
     * Register the package's commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
    }

}
