<?php

namespace Tests\Data\JSON\FoodServices\Menu\Components;

use Tests\Data\JSON\FoodServices\Menu\MenuModelTest;
use UWaterlooAPI\Data\JSON\FoodServices\Menu\Components\MealComponent;

class MenuComponentTest extends MenuModelTest
{
    public function testAccessors()
    {
        $outlet = $this->model->getOutletByName('REVelation');
        $menu = $outlet->getMenuByDay('Monday');
        $this->assertEquals('2016-03-07', $menu->getDate());
        $this->assertEquals('Monday', $menu->getDay());
        $this->assertNull($menu->getNotes());
        $this->assertEquals(2, $menu->getNumMeals());
    }

    public function testConstruction()
    {
        $outlet = $this->model->getOutletByName('REVelation');
        $menu = $outlet->getMenuByDay('Monday');
        $this->assertNull($menu->getBreakfast());
        $this->assertInstanceOf(MealComponent::class, $menu->getLunch());
        $this->assertInstanceOf(MealComponent::class, $menu->getDinner());
    }
}
