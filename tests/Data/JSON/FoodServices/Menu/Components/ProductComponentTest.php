<?php

namespace Tests\Data\JSON\FoodServices\Menu\Components;

use Tests\Data\JSON\FoodServices\Menu\MenuModelTest;

class ProductComponentTest extends MenuModelTest
{
    public function testAccessors()
    {
        $outlet = $this->model->getOutletByName('REVelation');
        $menu = $outlet->getMenuByDay('Monday');
        $meal = $menu->getLunch();
        $product = $meal->getProductByName('R - Spanikopita Twist');
        $this->assertEquals('R - Spanikopita Twist', $product->getProductName());
        $this->assertEquals(2566, $product->getProductId());
        $this->assertEquals('Halal', $product->getDietType());
    }
}
