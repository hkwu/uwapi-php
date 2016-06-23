<?php

namespace Tests\Data\JSON\FoodServices\Diets;

use Tests\Data\JSON\JSONTestCase;
use UWaterlooAPI\Data\JSON\FoodServices\Diets\Components\DietComponent;

class DietsModelTest extends JSONTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->model = $this->client->getFSDiets();
    }

    public function testGetDiets()
    {
        $this->assertEquals($this->model->getNumDiets(), count($this->model->getDiets()));
        $this->assertInstanceOf(DietComponent::class, $this->model->getDietByIndex(0));
        $this->assertInstanceOf(DietComponent::class, $this->model->getDietByType('Vegan'));
        $this->assertInstanceOf(DietComponent::class, $this->model->getDietById(7)); // Halal
    }
}
