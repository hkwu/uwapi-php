<?php

namespace Tests\Data\JSON\FoodServices\Announcements\Components;

use Tests\Data\JSON\FoodServices\Announcements\AnnouncementsModelTest;

class AnnouncementComponentTest extends AnnouncementsModelTest
{
    public function testComponentAccessors()
    {
        $this->assertEquals('2013-01-07', $this->model->getAnnouncementByIndex(0)->getDate());
        $this->assertEquals(
            'Try our newest dining concept on campus...The Chili Pepper - Tex Mex Cuisine.',
            $this->model->getAnnouncementByIndex(0)->getAdText()
        );
    }
}
