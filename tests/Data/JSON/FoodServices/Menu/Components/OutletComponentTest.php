<?php

namespace Tests\Data\JSON\FoodServices\Menu\Components;

use Tests\Data\JSON\FoodServices\Menu\MenuModelTest;
use UWaterlooAPI\Data\JSON\FoodServices\Menu\Components\MenuComponent;

class OutletComponentTest extends MenuModelTest
{
    public function testAccessors()
    {
        $outlet = $this->model->getOutletByName('REVelation');
        $this->assertEquals('REVelation', $outlet->getOutletName());
        $this->assertEquals(7, $outlet->getOutletId());
    }

    public function testConstruction()
    {
        $outlet = $this->model->getOutletByName('REVelation');
        $this->assertEquals($outlet->getNumMenus(), count($outlet->getMenus()));
        $this->assertInstanceOf(MenuComponent::class, $outlet->getMenuByIndex(0));
        $this->assertInstanceOf(MenuComponent::class, $outlet->getMenuByDay('Monday'));
    }
}
