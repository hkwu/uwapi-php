<?php

namespace Tests\Data\JSON\FoodServices\Menu\Components;

use Tests\Data\JSON\FoodServices\Menu\MenuModelTest;
use UWaterlooAPI\Data\JSON\FoodServices\Menu\Components\ProductComponent;

class MealComponentTest extends MenuModelTest
{
    public function testAccessors()
    {
        $outlet = $this->model->getOutletByName('REVelation');
        $menu = $outlet->getMenuByDay('Monday');
        $meal = $menu->getLunch();
        $this->assertEquals($meal->getNumProducts(), count($meal->getProducts()));
    }

    public function testConstruction()
    {
        $outlet = $this->model->getOutletByName('REVelation');
        $menu = $outlet->getMenuByDay('Monday');
        $meal = $menu->getLunch();
        $this->assertInstanceOf(ProductComponent::class, $meal->getProductByIndex(0));
        $this->assertInstanceOf(ProductComponent::class, $meal->getProductByName('R - Korean Taco with Spicy Slaw'));
        $this->assertInstanceOf(ProductComponent::class, $meal->getProductById(2706)); // R - Memphis Truck Stop Spaghetti
    }
}
