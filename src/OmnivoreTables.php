<?php


namespace lfrichter\omnivore;

use Httpful\Request;

class OmnivoreTables
{
    private $ES_FROM;
    private $ES_SIZE;
    private $omnivoreApiUrl;
    private $omnivoreApiKey;
    private $omnivoreLocationId;

    public function __construct()
    {
        $this->omnivoreApiUrl = env('OMNIVORE_API_URL');
        $this->omnivoreApiKey = env('OMNIVORE_API_KEY');
        $this->omnivoreLocationId = env('OMNIVORE_LOCATION_ID');
        $this->ES_FROM = env('ES_FROM', 0);
        $this->ES_SIZE = env('ES_SIZE', 10000);
        $this->client = new \GuzzleHttp\Client();
    }

    public function tableList($locationId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tables', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }

    public function tableRetrieve($locationId, $tableId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tables/' . $tableId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
}
