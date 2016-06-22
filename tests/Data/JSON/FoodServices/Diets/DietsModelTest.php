<?php

namespace Tests\Data\JSON\FoodServices\Diets;

use Tests\Data\DataTestCase;
use UWaterlooAPI\Data\JSON\FoodServices\Diets\Components\DietComponent;
use UWaterlooAPI\Requests\RequestClient;

class DietsModelTest extends DataTestCase
{
    protected $model;

    public function setUp()
    {
        parent::setUp();
        $this->model = $this->client->setFormat(RequestClient::JSON)->getFSDiets();
    }
    
    public function testGetDiets()
    {
        $diets = $this->model->getDiets();
        $this->assertEquals($this->model->getNumDiets(), count($diets));
        $this->assertInstanceOf(DietComponent::class, $this->model->getDietByIndex(0));
        $this->assertInstanceOf(DietComponent::class, $this->model->getDietByType('Vegan'));
        $this->assertInstanceOf(DietComponent::class, $this->model->getDietById(7)); // Halal
    }
}
