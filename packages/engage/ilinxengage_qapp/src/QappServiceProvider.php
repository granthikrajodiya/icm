<?php

namespace Engage\Ilinxengage_qapp;


use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class QappServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'engage_ilinxengage_qapp');
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
