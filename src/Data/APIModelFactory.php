<?php

namespace UWaterlooAPI\Data;

use UWaterlooAPI\Data\JSON\JSONModel;
use UWaterlooAPI\Data\XML\XMLModel;
use UWaterlooAPI\Client;

/**
 * Handles construction of API response models.
 */
class APIModelFactory
{
    /**
     * Instantiates an API data model.
     *
     * @param string $format The format of the API response body
     * @param string $data   The API response body in raw string format
     *
     * @return APIModel
     */
    public static function makeModel(string $format, string $data)
    {
        switch ($format) {
            case Client::JSON:
            case Client::GEOJSON:
                return new JSONModel($data);
            case Client::XML:
                return new XMLModel($data);
            default:
                return null;
        }
    }
}
