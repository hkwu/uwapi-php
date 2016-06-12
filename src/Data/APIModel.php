<?php

namespace UWaterlooAPI\Data;

abstract class APIModel
{
    private $rawData;

    public function __construct($rawData)
    {
        $this->rawData = $rawData;
    }

    public function getRawData()
    {
        return $this->rawData;
    }
}
