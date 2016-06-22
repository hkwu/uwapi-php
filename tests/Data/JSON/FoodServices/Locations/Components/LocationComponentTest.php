<?php

namespace Tests\Data\JSON\FoodServices\Locations\Components;

use Tests\Data\JSON\FoodServices\Locations\LocationsModelTest;
use UWaterlooAPI\Data\JSON\FoodServices\Locations\Components\OpeningHoursComponent;

class LocationComponentTest extends LocationsModelTest
{
    public function testAccessors()
    {
        $location = $this->model->getLocationByName('The Bombshelter Pub');
        $this->assertEquals(1210, $location->getOutletId());
        $this->assertEquals('SLC', $location->getBuilding());
        $this->assertNull($location->getLogo());
        $this->assertEquals(43.471476, $location->getLatitude(), '', static::FLOAT_DELTA);
        $this->assertEquals(-80.544893, $location->getLongitude(), '', static::FLOAT_DELTA);

        $desc = "The Bombshelter Pub, or as it’s more affectionately known, The Bomber, is the ultimate hang-out on campus!\n\nCome out every Wednesday to one of the longest running bar nights in KW hosted by your very own Federation of Students!";
        $this->assertEquals($desc, $location->getDescription());
        $notice = 'The Bombshelter Pub will be open for lunch from Dec 14th to the 18th from 11am to 3pm. Every table of 8 gets two free apps!';
        $this->assertEquals($notice, $location->getNotice());

        $this->assertFalse($location->getIs24Hrs());
        $this->assertInstanceOf(OpeningHoursComponent::class, $location->getSaturdayHours());
        $this->assertEquals('2015-12-19', $location->getDatesClosed()[0]);
    }
}
