<?php

namespace Tests\Data\JSON\FoodServices\Announcements;

use Tests\Data\DataTestCase;
use UWaterlooAPI\Requests\RequestClient;

class AnnouncementsModelTest extends DataTestCase
{
    public function testYearWeekAnnouncement()
    {
        $model = $this->client->makeRequest(RequestClient::FS_ANNOUNCEMENTS_YW, [2013, 2], RequestClient::JSON);
        $this->assertEquals(1, $model->getNumAnnouncements());
    }
}
