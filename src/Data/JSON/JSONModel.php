<?php

namespace UWaterlooAPI\Data\JSON;

use UWaterlooAPI\Data\APIModel;

class JSONModel extends APIModel
{
    private $decodedData;

    public function __construct($rawData)
    {
        parent::__construct($rawData);
        $this->decodedData = json_decode($rawData, true);
    }

    public function getEncodedData()
    {
        return $this->decodedData;
    }

    public function getMeta()
    {
        return $this->getJson(JSONModelConstants::KEY_META);
    }

    public function getData()
    {
        return $this->getJson(JSONModelConstants::KEY_DATA);
    }

    private function getJson(...$keys)
    {
        $val = $this->decodedData;

        foreach ($keys as $key) {
            $val = $val[$key];
        }

        return $val;
    }
}
