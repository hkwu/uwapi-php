<?php

namespace UWaterlooAPI\Data\JSON;

use UWaterlooAPI\Data\APIModel;

class JSONModel extends APIModel
{
    private $encodedData;

    public function __construct($rawData)
    {
        parent::__construct($rawData);
        $this->encodedData = json_encode($rawData);
    }

    public function getEncodedData()
    {
        return $this->encodedData;
    }

    public function getMeta()
    {
        return $this->getJson(JSONModelConstants::META);
    }

    public function getData()
    {
        return $this->getJson(JSONModelConstants::DATA);
    }

    private function getJson(...$keys)
    {
        $val = $this->encodedData;

        foreach ($keys as $key) {
            $val = $val[$key];
        }

        return $val;
    }
}
