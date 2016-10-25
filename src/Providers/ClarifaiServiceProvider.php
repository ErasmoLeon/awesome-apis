<?php

namespace Eleon\AwesomeApis\Providers;

use Illuminate\Support\ServiceProvider;
use Eleon\AwesomeApis\Services\ClarifaiService;

class ClarifaiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('ClarifaiService', function () {
            return new ClarifaiService(env('CLARIFAI_CLIENT_ID'), env('CLARIFAI_CLIENT_PASSWORD'));
        });
    }
}
