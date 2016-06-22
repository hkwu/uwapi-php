<?php

namespace Tests\Data\JSON\FoodServices\Announcements;

use Tests\Data\DataTestCase;
use UWaterlooAPI\Data\JSON\FoodServices\Announcements\Components\AnnouncementComponent;
use UWaterlooAPI\Requests\RequestClient;

class AnnouncementsModelTest extends DataTestCase
{
    protected $model;

    public function setUp()
    {
        parent::setUp();
        $this->model = $this->client->setFormat(RequestClient::JSON)->getFSAnnouncements(2013, 2);
    }
    
    public function testGetYearWeekAnnouncements()
    {
        $announcements = $this->model->getAnnouncements();
        $this->assertEquals($this->model->getNumAnnouncements(), count($announcements));
        $this->assertInstanceOf(AnnouncementComponent::class, $this->model->getAnnouncementByIndex(0));
    }
}
