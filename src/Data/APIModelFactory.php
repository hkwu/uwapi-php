<?php

namespace UWaterlooAPI\Data;

use UWaterlooAPI\Data\JSON\Common\BaseModel;
use UWaterlooAPI\Data\JSON\FoodServices\Diets\DietsModel;
use UWaterlooAPI\Data\JSON\FoodServices\Locations\LocationsModel;
use UWaterlooAPI\Data\JSON\FoodServices\Menu\MenuModel;
use UWaterlooAPI\Data\JSON\FoodServices\Notes\NotesModel;
use UWaterlooAPI\Data\JSON\FoodServices\Outlets\OutletsModel;
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
                    case RequestClient::FS_NOTES_YW:
                    case RequestClient::FS_NOTES:
                        return new NotesModel($data);
                    case RequestClient::FS_DIETS:
                        return new DietsModel($data);
                    case RequestClient::FS_OUTLETS:
                        return new OutletsModel($data);
                    case RequestClient::FS_LOCATIONS:
                        return new LocationsModel($data);
                    default:
                        return new BaseModel($data);
                }
            case RequestClient::XML:
                return new XMLModel($data);
            default:
                return;
        }
    }
}
