<?php

namespace Tests\Data\JSON\FoodServices\Announcements;

use Tests\Data\JSON\JSONTestCase;
use UWaterlooAPI\Data\JSON\FoodServices\Announcements\Components\AnnouncementComponent;

class AnnouncementsModelTest extends JSONTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->model = $this->client->getFSAnnouncements(2013, 2);
    }

    public function testGetYearWeekAnnouncements()
    {
        $this->assertEquals($this->model->getNumAnnouncements(), count($this->model->getAnnouncements()));
        $this->assertInstanceOf(AnnouncementComponent::class, $this->model->getAnnouncementByIndex(0));
    }
}
