<?php

namespace Eleon\AwesomeApis\Providers;

use Illuminate\Support\ServiceProvider;
use Eleon\AwesomeApis\Services\MeaningCloudService;

class MeaningCloudServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('AwesomeApis\MeaningCloudService', function () {
            return new MeaningCloudService(config('meaningCloudSecretKey'));
        });
    }
}
