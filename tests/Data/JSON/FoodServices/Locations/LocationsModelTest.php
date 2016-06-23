<?php

namespace Tests\Data\JSON\FoodServices\Locations;

use Tests\Data\JSON\JSONTestCase;
use UWaterlooAPI\Data\JSON\FoodServices\Locations\Components\LocationComponent;

class LocationsModelTest extends JSONTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->model = $this->client->getFSLocations();
    }
    
    public function testGetLocations()
    {
        $this->assertEquals($this->model->getNumLocations(), count($this->model->getLocations()));
        $this->assertInstanceOf(LocationComponent::class, $this->model->getLocationByIndex(0));
        $this->assertInstanceOf(LocationComponent::class, $this->model->getLocationById(20)); // Browsers Café - Dana Porter Library
        $this->assertInstanceOf(LocationComponent::class, $this->model->getLocationByName('Tim Hortons - Student Life Centre'));
    }
}
