<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LarahomePackageProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $schema =$this->app->make('Schema');
        $schema::hasTable('plugins');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
