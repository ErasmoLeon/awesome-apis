<?php

namespace Eleon\AwesomeApis\Providers;

use Illuminate\Support\ServiceProvider;
use Eleon\AwesomeApis\Services\MercadoLibreService;

class MercadoLibreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('MercadoLibreService', function () {
            return new MercadoLibreService();
        });
    }
}
