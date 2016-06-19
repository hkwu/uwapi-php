<?php

namespace UWaterlooAPI\Data\JSON\Common;

use UWaterlooAPI\Data\JSON\JSONModel;
use UWaterlooAPI\Data\JSON\JSONModelConstants;

class BaseModel extends JSONModel
{
    public function __construct($rawData)
    {
        parent::__construct($rawData);
    }

    public function getMeta()
    {
        return $this->get(JSONModelConstants::META);
    }

    public function getData()
    {
        return $this->get(JSONModelConstants::DATA);
    }
}
