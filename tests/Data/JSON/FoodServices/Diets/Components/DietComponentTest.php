<?php

namespace Tests\Data\JSON\FoodServices\Diets\Components;

use Tests\Data\DataTestCase;
use UWaterlooAPI\Requests\RequestClient;

class DietComponentTest extends DataTestCase
{
    public function testAccessors()
    {
        $model = $this->client->setFormat(RequestClient::JSON)->getFSDiets();
        $vegetarian = $model->getDietByType('Vegetarian');
        $this->assertEquals('Vegetarian', $vegetarian->getDietType());
        $this->assertEquals(6, $vegetarian->getDietId());
    }
}
