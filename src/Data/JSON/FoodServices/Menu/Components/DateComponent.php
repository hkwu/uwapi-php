<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Menu\Components;

use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;

class DateComponent extends BaseComponent
{
    private $week;
    private $year;
    private $start;
    private $end;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->week = $this->get(JSONModelConstants::WEEK);
        $this->year = $this->get(JSONModelConstants::YEAR);
        $this->start = $this->get(JSONModelConstants::START);
        $this->end = $this->get(JSONModelConstants::END);
    }

    public function getWeek()
    {
        return $this->week;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }
}
