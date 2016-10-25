<?php

namespace Eleon\AwesomeApis\Providers;

use Illuminate\Support\ServiceProvider;
use Eleon\AwesomeApis\Services\TwitterService;

class TwitterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('TwitterService', function () {
            return new TwitterService(env('TWITTER_CLIENT_ID'), env('TWITTER_CLIENT_PASSWORD'));
        });
    }
}
