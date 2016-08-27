<?php

namespace UWaterlooAPI\Data;

use UWaterlooAPI\Data\JSON\JSONModel;
use UWaterlooAPI\Data\XML\XMLModel;
use UWaterlooAPI\Requests\Client;

/**
 * Handles construction of API response models.
 * @package UWaterlooAPI\Data
 */
class APIModelFactory
{
    /**
     * Instantiates an API data model.
     * @param string $format The format of the API response body.
     * @param string $data The API response body in raw string format.
     * @return APIModel
     */
    public static function makeModel($format, $data)
    {
        switch ($format) {
            case Client::JSON:
                return new JSONModel($data);
            case Client::XML:
                return new XMLModel($data);
            default:
                return;
        }
    }
}
