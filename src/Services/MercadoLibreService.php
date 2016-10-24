<?php

namespace Eleon\AwesomeApis\Services;

use GuzzleHttp\Client;

class MercadoLibreService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function searchItems($query, $site = 'MLM')
    {
        $request = $this->client->request('GET', "https://api.mercadolibre.com/sites/$site/search?q=$query");
        return json_decode($request->getBody());
    }
}