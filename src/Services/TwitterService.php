<?php

namespace Eleon\AwesomeApis\Services;

use GuzzleHttp\Client;

class TwitterService
{
    private $client;
    private $apiUrl = 'https://api.twitter.com';
    private $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->authentication();
    }

    public function authentication($clientId, $clientPassword)
    {
        $request = $this->client->request('POST', "$this->apiUrl/oauth2/token", [
            'form_params' => [
                'grant_type' => 'client_credentials'
            ],
            'auth' => [
                $clientId,
                $clientPassword
            ]
        ]);

        $data = json_decode($request->getBody());

        $this->token = $data->access_token;
    }

    public function searchTweets($query, $count = 10)
    {
        $request = $this->client->request('GET', "$this->apiUrl/1.1/search/tweets.json?q=$query&count=$count",
            [
                'headers' => [
                    'Authorization' => "Bearer $this->token"
                ]
            ]
        );
        $tweets = json_decode($request->getBody());
        return array_map(function ($tweet) {
            return $tweet->text;
        }, $tweets->statuses);
    }

}