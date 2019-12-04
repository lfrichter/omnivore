<?php


namespace lfrichter\omnivore;

use Httpful\Request;

class OmnivoreGeneral
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
    public function locationList()
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function locationRetrieve($locationId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function employeeList($locationId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/employees', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function employeeRetrieve($locationId, $employeeId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/employees/' . $employeeId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function orderTypeList($locationId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/order_types', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function orderTypeRetrieve($locationId, $orderTypeId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/order_types/' . $orderTypeId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function tenderTypeList($locationId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tender_types', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function tenderTypeRetrieve($locationId, $tenderTypeId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/tender_types/' . $tenderTypeId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function revenueCenterList($locationId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/revenue_centers', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function revenueCenterRetrieve($locationId, $revenueCenterId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/revenue_centers/' . $revenueCenterId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function discountList($locationId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/discounts', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function discountRetrieve($locationId, $discountId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/discounts/' . $discountId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function menu($locationId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/menu', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function categoryList($locationId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/menu/categories', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function categoryRetrieve($locationId, $categoryId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/menu/categories/' . $categoryId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function menuItemList($locationId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/menu/items/', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function menuItemRetrieve($locationId, $menuItemId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/menu/items/' . $menuItemId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function modifierList($locationId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/menu/modifiers/', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function modifierRetrieve($locationId, $modifierId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/menu/modifiers/' . $modifierId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function modifierGroupList($locationId, $menuItemId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/menu/items/' . $menuItemId . '/modifier_groups', [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
    public function modifierGroupRetrieve($locationId, $menuItemId, $modifierGroupId)
    {
        $res = $this->client->request('GET', $this->omnivoreApiUrl . 'locations/' . $locationId . '/menu/items/' . $menuItemId . '/modifier_groups/' . $modifierGroupId, [
            'headers' => [
                'Api-Key' => $this->omnivoreApiKey
            ]
        ]);
        return json_decode($res->getBody());
    }
}
