<?php

namespace Tests\Data\JSON\FoodServices\Menu\Components;

use Tests\Data\JSON\FoodServices\Menu\MenuModelTest;

class DateComponentTest extends MenuModelTest
{
    public function testAccessors()
    {
        $date = $this->model->getDate();
        $this->assertEquals(10, $date->getWeek());
        $this->assertEquals(2016, $date->getYear());
        $this->assertEquals('2016-03-07', $date->getStart());
        $this->assertEquals('2016-03-11', $date->getEnd());
    }
}
