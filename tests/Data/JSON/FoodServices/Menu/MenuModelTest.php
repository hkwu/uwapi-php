<?php

namespace Tests\Data\JSON\FoodServices\Menu;

use Tests\Data\JSON\JSONTestCase;
use UWaterlooAPI\Data\JSON\FoodServices\Menu\Components\DateComponent;
use UWaterlooAPI\Data\JSON\FoodServices\Menu\Components\OutletComponent;

class MenuModelTest extends JSONTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->model = $this->client->getFSMenu(2016, 10);
    }

    public function testGetYearWeekMenu()
    {
        $this->assertEquals($this->model->getNumOutlets(), count($this->model->getOutlets()));
        $this->assertInstanceOf(DateComponent::class, $this->model->getDate());
        $this->assertInstanceOf(OutletComponent::class, $this->model->getOutletByIndex(0));
        $this->assertInstanceOf(OutletComponent::class, $this->model->getOutletById(7)); // REVelation
        $this->assertInstanceOf(OutletComponent::class, $this->model->getOutletByName('REVelation'));
    }
}
