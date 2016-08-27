<?php

namespace Tests\Requests;

use Tests\APITestCase;
use UWaterlooAPI\Data\JSON\JSONModel;
use UWaterlooAPI\Data\XML\XMLModel;
use UWaterlooAPI\Client;
use UWaterlooAPI\Endpoints;

class RequestClientTest extends APITestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->client->setConfig([
            'async' => false,
        ]);
    }

    public function testRequestBadFormatException()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid format specified for request: weird.');
        $this->client->request(Endpoints::API_CHANGELOG, [], [
            'format' => 'weird',
        ]);
    }

    public function testRequest()
    {
        // test with JSON format
        $jsonModel = $this->client->request(Endpoints::FS_OUTLETS);
        $this->assertInstanceOf(JSONModel::class, $jsonModel);
        $this->assertNotEmpty($jsonModel->getDecodedData());

        // test with GeoJSON format
        $jsonModel = $this->client->request(Endpoints::BUILDINGS_LIST);
        $this->assertInstanceOf(JSONModel::class, $jsonModel);
        $this->assertNotEmpty($jsonModel->getDecodedData());

        // test with XML format
        $xmlModel = $this->client->request(Endpoints::FS_OUTLETS, [], [
            'format' => Client::XML,
        ]);
        $this->assertInstanceOf(XMLModel::class, $xmlModel);
        $this->assertNotEmpty($xmlModel->getRawData());
    }

    public function testAsyncRequest()
    {
        $this->client->request(Endpoints::FS_MENU, [], [
            'async' => true,
        ])->then(function ($model) {
            $this->assertInstanceOf(JSONModel::class, $model);
            $this->assertNotEmpty($model->getDecodedData());
        });

        $this->client->request(Endpoints::FS_LOCATIONS, [], [
            'async' => true,
        ])->then(function ($model) {
            $this->assertInstanceOf(JSONModel::class, $model);
            $this->assertNotEmpty($model->getDecodedData());
        });
    }

    public function testBatchRequests()
    {
        // test with JSON format
        $endpoints = [
            'fsMenu' => Endpoints::FS_MENU,
            'coursesClassSchedule' => Endpoints::COURSES_CLASS_SCHEDULE,
            'poiAtms' => Endpoints::POI_ATMS,
        ];

        $jsonModels = $this->client->batch($endpoints);

        foreach ($jsonModels as $jsonModel) {
            $this->assertInstanceOf(JSONModel::class, $jsonModel);
            $this->assertNotEmpty($jsonModel->getDecodedData());
        }

        // test with GeoJSON format
        $options = [
            'format' => Client::GEOJSON,
        ];

        $geoJsonModels = $this->client->batch($endpoints, [], $options);

        foreach ($geoJsonModels as $geoJsonModel) {
            $this->assertInstanceOf(JSONModel::class, $geoJsonModel);
            $this->assertNotEmpty($geoJsonModel->getRawData());
        }

        // test with XML format
        $options = [
            'format' => Client::XML,
        ];

        $xmlModels = $this->client->batch($endpoints, [], $options);

        foreach ($xmlModels as $xmlModel) {
            $this->assertInstanceOf(XMLModel::class, $xmlModel);
            $this->assertNotEmpty($xmlModel->getRawData());
        }
    }
}
