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
        $this->week = $decodedData[JSONModelConstants::WEEK];
        $this->year = $decodedData[JSONModelConstants::YEAR];
        $this->start = $decodedData[JSONModelConstants::START];
        $this->end = $decodedData[JSONModelConstants::END];
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
