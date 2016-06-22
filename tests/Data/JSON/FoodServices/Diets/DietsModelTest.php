<?php

namespace Tests\Data\JSON\FoodServices\Diets;

use Tests\Data\DataTestCase;
use UWaterlooAPI\Data\JSON\FoodServices\Diets\Components\DietComponent;
use UWaterlooAPI\Requests\RequestClient;

class DietsModelTest extends DataTestCase
{
    public function testGetDiets()
    {
        $model = $this->client->setFormat(RequestClient::JSON)->getFSDiets();
        $diets = $model->getDiets();

        $this->assertEquals(4, $model->getNumDiets());
        $this->assertEquals(4, count($diets));
        $this->assertInstanceOf(DietComponent::class, $model->getDietByIndex(0));
        $this->assertInstanceOf(DietComponent::class, $model->getDietByType('Vegan'));
        $this->assertInstanceOf(DietComponent::class, $model->getDietById(7));
    }
}
