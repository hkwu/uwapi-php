<?php

namespace Tests\Data\JSON\FoodServices\Locations;

use Tests\Data\DataTestCase;
use UWaterlooAPI\Data\JSON\FoodServices\Locations\Components\LocationComponent;
use UWaterlooAPI\Requests\RequestClient;

class LocationsModelTest extends DataTestCase
{
    protected $model;

    public function setUp()
    {
        parent::setUp();
        $this->model = $this->client->setFormat(RequestClient::JSON)->getFSLocations();
    }
    
    public function testGetLocations()
    {
        $locations = $this->model->getLocations();
        $this->assertEquals($this->model->getNumLocations(), count($locations));
        $this->assertInstanceOf(LocationComponent::class, $this->model->getLocationByIndex(0));
        $this->assertInstanceOf(LocationComponent::class, $this->model->getLocationById(20)); // Browsers Café - Dana Porter Library
        $this->assertInstanceOf(LocationComponent::class, $this->model->getLocationByName('Tim Hortons - Student Life Centre'));
    }
}
