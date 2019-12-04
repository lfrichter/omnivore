<?php

namespace lfrichter\omnivore;

use Httpful\Request;

class OmnivoreTickets
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

    public function ticketList($locationId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketOpen($locationId, $content)
    {
        $res = $this->client->request('POST', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets', [
            'json' => $content,
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketRetrieve($locationId, $ticketId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketVoid($locationId, $ticketId)
    {
        $res = $this->client->request('DELETE', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketDiscountList($locationId, $ticketId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/discounts', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketDiscountApply($locationId, $ticketId, $discount, $value)
    {
        $res = $this->client->request('POST', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/discounts', [
            'body' => [
                'discount' => $discount,
                'value' => $value
            ],
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketDiscountRetrieve($locationId, $ticketId, $ticketDiscountId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/discounts/' . $ticketDiscountId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketItemList($locationId, $ticketId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/items', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketItemAdd($locationId, $ticketId, $content)
    {
        $res = $this->client->request('POST', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/items', [
            'json' => $content,
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketItemRetrieve($locationId, $ticketId, $ticketItemId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/items/' . $ticketItemId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketItemVoid($locationId, $ticketId, $ticketItemId)
    {
        $res = $this->client->request('DELETE', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/items/' . $ticketItemId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketItemModifierList($locationId, $ticketId, $ticketItemId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/items/' . $ticketItemId . '/modifiers', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketItemModifierRetrieve($locationId, $ticketId, $ticketItemId, $ticketItemModifierId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/items/' . $ticketItemId . '/modifiers/' . $ticketItemModifierId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketItemDiscountList($locationId, $ticketId, $ticketItemId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/items/' . $ticketItemId . '/discounts', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function ticketItemDiscountRetrieve($locationId, $ticketId, $ticketItemId, $ticketItemDiscountId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/items/' . $ticketItemId . '/discount/' . $ticketItemDiscountId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function paymentList($locationId, $ticketId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/payments/', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function paymentRetrieve($locationId, $ticketId, $paymentId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/payments/' . $paymentId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function paymentCardNotPresent($locationId, $ticketId, $content)
    {
        $res = $this->client->request('POST', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/payments', [
            'json' => $content,
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function paymentCardPresent($locationId, $ticketId, $content)
    {
        $res = $this->client->request('POST', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/payments', [
            'json' => $content,
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function payment3rdParty($locationId, $ticketId, $content)
    {
        $res = $this->client->request('POST', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/payments', [
            'json' => $content,
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function paymentGiftCard($locationId, $ticketId, $content)
    {
        $res = $this->client->request('POST', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/payments', [
            'json' => $content,
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function paymentCash($locationId, $ticketId, $content)
    {
        $res = $this->client->request('POST', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tickets/' . $ticketId . '/payments', [
            'json' => $content,
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
}
