<?php

namespace Eleon\AwesomeApis\Services;

use GuzzleHttp\Client;

class ClarifaiService
{
    private $client;
    private $apiUrl = 'https://api.clarifai.com';
    private $token;

    public function __construct($clientId, $clientPassword)
    {
        $this->client = new Client();
        $this->authentication($clientId, $clientPassword);
    }

    public function authentication($clientId, $clientPassword)
    {
        $request = $this->client->request('POST', "$this->apiUrl/v1/token/", [
            'form_params' => [
                'grant_type' => 'client_credentials'
            ],
            'auth' => [
                $clientId, $clientPassword
            ]
        ]);

        $data = json_decode($request->getBody());

        $this->token = $data->access_token;
    }

    public function searchEntitiesByUrl($url, $model = 'general-v1.3', $lang = 'es')
    {
        $request = $this->client->request('GET', "$this->apiUrl/v1/tag/?language=$lang&model=$model&url=$url",
            [
                'headers' => [
                    'Authorization' => "Bearer $this->token"
                ]
            ]
        );
        $data = json_decode($request->getBody());
        $data->results->result->tag->classes;
    }
}
