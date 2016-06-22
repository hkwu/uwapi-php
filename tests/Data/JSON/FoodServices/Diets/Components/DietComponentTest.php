<?php

namespace Tests\Data\JSON\FoodServices\Diets\Components;

use Tests\Data\JSON\FoodServices\Diets\DietsModelTest;

class DietComponentTest extends DietsModelTest
{
    public function testAccessors()
    {
        $vegetarian = $this->model->getDietByType('Vegetarian');
        $this->assertEquals('Vegetarian', $vegetarian->getDietType());
        $this->assertEquals(6, $vegetarian->getDietId());
    }
}
