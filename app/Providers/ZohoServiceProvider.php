<?php

namespace App\Providers;

use App\Zoho\Zoho;
use Illuminate\Support\ServiceProvider;

class ZohoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('zoho',function(){
            return new Zoho;
        });
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
