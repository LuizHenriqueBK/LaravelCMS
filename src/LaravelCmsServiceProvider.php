<?php

namespace LuizHenriqueBK\LaravelCMS;

use Illuminate\Support\ServiceProvider;

class LaravelCmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void§
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\LaravelCmsCommand::class
            ]);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
