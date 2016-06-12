<?php

namespace UWaterlooAPI\Data;

use UWaterlooAPI\Data\JSON\JSONModel;
use UWaterlooAPI\Data\XML\XMLModel;
use UWaterlooAPI\Requests\RequestConstants;

class APIModelFactory
{
    public static function makeModel($type, $data)
    {
        switch ($type) {
            case RequestConstants::JSON:
                return new JSONModel($data);
            case RequestConstants::XML:
                return new XMLModel($data);
        }
    }
}