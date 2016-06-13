<?php

namespace UWaterlooAPI\Data;

use UWaterlooAPI\Data\JSON\Common\BaseModel;
use UWaterlooAPI\Data\JSON\FoodServices\Menu\MenuModel;
use UWaterlooAPI\Data\XML\XMLModel;
use UWaterlooAPI\Requests\RequestClient;

class APIModelFactory
{
    public static function makeModel($format, $endpoint, $data)
    {
        switch ($format) {
            case RequestClient::JSON:
                switch ($endpoint) {
                    case RequestClient::FS_MENU:
                        return new MenuModel($data);
                    default:
                        return new BaseModel($data);
                }
            case RequestClient::XML:
                return new XMLModel($data);
            default:
                return null;
        }
    }
}
