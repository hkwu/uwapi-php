<?php

namespace Tests\Data\JSON;

use Tests\Data\DataTestCase;
use UWaterlooAPI\Data\JSON\JSONModel;
use UWaterlooAPI\Requests\Client;
use UWaterlooAPI\Requests\Endpoints;

class JSONModelTest extends DataTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->client->setConfig([
            'format' => Client::JSON,
            'async' => false,
        ]);
    }

    public function testCreation()
    {
        $mock = [
            'meta' => [],
            'data' => [],
        ];

        $model = new JSONModel(json_encode($mock));
        $this->assertEquals(json_encode($mock), $model->getRawData());
        $this->assertNotEmpty($model->getDecodedData());
    }

    public function testAccessors()
    {
        $mock = [
            'meta' => [
                'requests' => static::$faker->randomNumber,
                'timestamp' => static::$faker->randomNumber,
                'status' => 200,
                'message' => 'Request successful',
            ],
            'data' => [
                [
                    'outlet_id' => static::$faker->randomDigitNotNull,
                    'outlet_name' => static::$faker->company,
                    'has_breakfast' => (int) static::$faker->boolean,
                    'has_lunch' => (int) static::$faker->boolean,
                    'has_dinner' => (int) static::$faker->boolean,
                ],
            ],
        ];

        $model = new JSONModel(json_encode($mock));
        $this->assertEquals(json_encode($mock), $model->getRawData());
        $this->assertEquals($mock, $model->getDecodedData());
        $this->assertEquals($mock['meta'], $model->getMeta());
        $this->assertEquals($mock['data'], $model->getData());
        $this->assertEquals($mock['data'][0]['has_lunch'], $model->get('data', 0, 'has_lunch'));
    }

    public function testWithClient()
    {
        $model = $this->client->request(Endpoints::API_METHODS);
        $this->assertInstanceOf(JSONModel::class, $model);
        $this->assertNotEmpty($model->getRawData());
        $this->assertNotEmpty($model->getDecodedData());
    }
}
