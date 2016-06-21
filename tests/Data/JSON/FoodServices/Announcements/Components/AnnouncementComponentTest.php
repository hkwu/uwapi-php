<?php

namespace Tests\Data\JSON\FoodServices\Announcements\Components;

use Tests\Data\DataTestCase;
use UWaterlooAPI\Requests\RequestClient;

class AnnouncementComponentTest extends DataTestCase
{
    public function testComponentAccessors()
    {
        $model = $this->client->setFormat(RequestClient::JSON)->getFSAnnouncements(2013, 2);
        $this->assertEquals('2013-01-07', $model->getAnnouncementByIndex(0)->getDate());
        $this->assertEquals(
            'Try our newest dining concept on campus...The Chili Pepper - Tex Mex Cuisine.',
            $model->getAnnouncementByIndex(0)->getAdText()
        );
    }
}
