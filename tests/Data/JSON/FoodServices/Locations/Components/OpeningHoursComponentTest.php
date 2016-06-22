<?php

namespace Tests\Data\JSON\FoodServices\Locations\Components;

use Tests\Data\JSON\FoodServices\Locations\LocationsModelTest;

class OpeningHoursComponentTest extends LocationsModelTest
{
    public function testAccessors()
    {
        $location = $this->model->getLocationByName('Liquid Assets Cafe - Hagey Hall');

        $sundayHours = $location->getSundayHours();
        $this->assertNull($sundayHours->getOpeningHour());
        $this->assertNull($sundayHours->getClosingHour());
        $this->assertTrue($sundayHours->getIsClosed());

        $mondayHours = $location->getMondayHours();
        $this->assertEquals('08:00', $mondayHours->getOpeningHour());
        $this->assertEquals('15:00', $mondayHours->getClosingHour());
        $this->assertFalse($mondayHours->getIsClosed());
    }
}
