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
//        $schema = $this->app->make('Schema');
//        if($schema::hasTable('plugins'))
//        {
//            foreach (\App\Plugin::where('enable', '=', '1')->get() as $plugin) {
//                $this->app->register($plugin->provider);
//            }
//        }
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
