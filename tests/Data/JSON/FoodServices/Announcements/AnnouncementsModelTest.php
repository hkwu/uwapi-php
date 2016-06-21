<?php

namespace Tests\Data\JSON\FoodServices\Announcements;

use Tests\Data\DataTestCase;
use UWaterlooAPI\Data\JSON\FoodServices\Announcements\Components\AnnouncementComponent;
use UWaterlooAPI\Requests\RequestClient;

class AnnouncementsModelTest extends DataTestCase
{
    public function testGetYearWeekAnnouncements()
    {
        $model = $this->client->setFormat(RequestClient::JSON)->getFSAnnouncements(2013, 2);
        $announcements = $model->getAnnouncements();
        
        $this->assertEquals(1, $model->getNumAnnouncements());
        $this->assertEquals(1, count($announcements));
        $this->assertInstanceOf(AnnouncementComponent::class, $announcements[0]);
    }
}
