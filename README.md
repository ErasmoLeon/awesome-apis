#1.- Add env vars to .env file

```
MEANING_CLOUD_SECRET_KEY=9456dgfgerjukikf89eqwbbqweqwe259kidd5
TWITTER_CLIENT_ID=qwekvfhirgotmo78456456
TWITTER_CLIENT_PASSWORD=g0ri093453j45k39fud9fi9dfigdfg0lkn34f
CLARIFAI_CLIENT_ID=k4h534j5lkfdgoidugfiojlth
CLARIFAI_CLIENT_PASSWORD=TAyGSjA¡2ZKwtKVyYOJodUGeNu4l534hfkd
```

#2.- Register providers in bootstrap/app.php

```
$app->register(Eleon\AwesomeApis\Providers\MeaningCloudServiceProvider::class);
$app->register(Eleon\AwesomeApis\Providers\ClarifaiServiceProvider::class);
$app->register(Eleon\AwesomeApis\Providers\TwitterServiceProvider::class);
$app->register(Eleon\AwesomeApis\Providers\MercadoLibreServiceProvider::class);
```

#3.- Usage

```
$meaningCloudService = app()->make('MeaningCloudService');
$twitterService = app()->make('TwitterService');
$mercadolibreService = app()->make('MercadoLibreService');
$clarifaiService = app()->make('ClarifaiService');
```