<?php

namespace UWaterlooAPI\Data\JSON\Common;

use UWaterlooAPI\Data\JSON\JSONModel;
use UWaterlooAPI\Data\JSON\JSONModelConstants;
use UWaterlooAPI\Utils\ArrayUtil;

class BaseModel extends JSONModel
{
    public function __construct($rawData)
    {
        parent::__construct($rawData);
    }

    public function getMeta()
    {
        return ArrayUtil::getVal($this->getDecodedData(), JSONModelConstants::META);
    }

    public function getData()
    {
        return ArrayUtil::getVal($this->getDecodedData(), JSONModelConstants::DATA);
    }
}