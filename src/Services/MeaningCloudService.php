<?php

namespace Eleon\AwesomeApis\Services;

use GuzzleHttp\Client;

class MeaningCloudService
{
    private $client;
    private $apiUrl = 'https://api.meaningcloud.com/topics-2.0';
    private $secretKey;
    private $blakcList = [
        "Top>Id>Hashtag",
        "Top>Location>GeoPoliticalEntity>City",
        "Top>Location>GeoPoliticalEntity>Country",
        "Top>Id>Url",
        "Top>Id>Nickname",
        "Top>Organization>Government",
        "Top>SocialSciences>Economy",
        "Top>OtherEntity>Title"
    ];

    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
        $this->client = new Client();
    }

    public function getTopics(array $texts)
    {
        $topicsResponse = [];
        foreach ($texts as $text) {
            $topics = $this->getTopicByText($text);
            if (count($topics) > 0) {
                $topicsResponse = array_merge($topics, $topicsResponse);
            }
        }
        return $topicsResponse;
    }

    public function getTopicByText($text)
    {
        $request = $this->client->request('POST', $this->apiUrl, [
            'form_params' => [
                'key' => $this->secretKey,
                'tt' => 'e',
                'lang' => 'es',
                'txt' => $text
            ]
        ]);

        $topic = json_decode($request->getBody());

        return $this->filterEntities($topic);
    }

    public function filterEntities($topic)
    {
        $topicData = [];
        if (!property_exists($topic, 'entity_list')) {
            return $topicData;
        }
        foreach ($topic->entity_list as $entity) {
            if (!in_array($entity->sementity->type, $this->blakcList)) {
                array_push($topicData, $entity->form);
            }
        }
        return $topicData;
    }
}