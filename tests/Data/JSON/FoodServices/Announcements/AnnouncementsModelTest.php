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

        $this->assertEquals($model->getNumAnnouncements(), count($announcements));
        $this->assertInstanceOf(AnnouncementComponent::class, $model->getAnnouncementByIndex(0));
    }
}
