<?php

namespace Tests\Requests;

use Tests\APITestCase;
use UWaterlooAPI\Data\JSON\FoodServices\Locations\LocationsModel;
use UWaterlooAPI\Data\JSON\FoodServices\Menu\MenuModel;
use UWaterlooAPI\Data\JSON\FoodServices\Outlets\OutletsModel;
use UWaterlooAPI\Requests\AsyncWrapper;
use UWaterlooAPI\Requests\RequestClient;

class RequestClientTest extends APITestCase
{
    private $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = new RequestClient(getenv('API_KEY'));
    }

    public function testMakeRequestsBadFormatException()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid format specified for request: weird.');
        $this->client->makeRequest(RequestClient::API_CHANGELOG, [], [
            'format' => 'weird',
        ]);
    }

    public function testMakeRequestsMissingFormatException()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid format specified for request: .');
        $this->client->makeRequest(RequestClient::API_CHANGELOG);
    }

    public function testMakeRequests()
    {
        // synchronous request
        $model = $this->client->makeRequest(RequestClient::FS_OUTLETS, [], [
            'format' => RequestClient::JSON,
        ]);
        $this->assertInstanceOf(OutletsModel::class, $model);

        // asynchronous request
        $wrapper = $this->client->makeRequest(RequestClient::FS_OUTLETS, [], [
            'format' => RequestClient::JSON,
            'async' => true,
        ]);
        $model = $this->client->getAsyncResponse($wrapper);
        $this->assertInstanceOf(AsyncWrapper::class, $wrapper);
        $this->assertInstanceOf(OutletsModel::class, $model);
    }

    public function testAsyncRequests()
    {
        $time = -microtime(true);
        $menuWrapper = $this->client->getFSMenu([], [
            'format' => RequestClient::JSON,
            'async' => true,
        ]);
        $locationsWrapper = $this->client->getFSLocations([], [
            'format' => RequestClient::JSON,
            'async' => true,
        ]);
        $this->assertInstanceOf(AsyncWrapper::class, $menuWrapper);
        $this->assertInstanceOf(AsyncWrapper::class, $locationsWrapper);
        $time += microtime(true);
        $this->assertLessThanOrEqual(0.1, $time); // should be very short

        $menuModel = $this->client->getAsyncResponse($menuWrapper);
        $locationsModel = $this->client->getAsyncResponse($locationsWrapper);
        $this->assertInstanceOf(MenuModel::class, $menuModel);
        $this->assertInstanceOf(LocationsModel::class, $locationsModel);
    }

    public function testBatchRequests()
    {
        // get time for consecutive requests
        $nonBatchedTime = -microtime(true);
        $menuModel = $this->client->getFSMenu([], [
            'format' => RequestClient::JSON,
        ]);
        $this->client->getFSMenu([], [
            'format' => RequestClient::JSON,
        ]);
        $this->client->getFSMenu([], [
            'format' => RequestClient::JSON,
        ]);
        $nonBatchedTime += microtime(true);

        // get time for batched requests
        $endpoints = [
            RequestClient::FS_MENU,
            RequestClient::FS_MENU,
            RequestClient::FS_MENU,
        ];
        $params = [
            'format' => RequestClient::JSON,
        ];

        $batchedTime = -microtime(true);
        $models = $this->client->batchRequests($endpoints, [], $params);
        $batchedTime += microtime(true);

        $this->assertLessThanOrEqual($nonBatchedTime, $batchedTime);
        $this->assertInstanceOf(MenuModel::class, $menuModel);

        foreach ($models as $model) {
            $this->assertInstanceOf(MenuModel::class, $model);
        }
    }
}
