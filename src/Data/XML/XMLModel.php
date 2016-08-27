<?php

namespace UWaterlooAPI\Data\XML;

use UWaterlooAPI\Data\APIModel;

/**
 * Class wrapping API responses returned as XML.
 */
class XMLModel extends APIModel
{
    /**
     * XMLModel constructor.
     *
     * @param string $rawData Raw data returned from the API
     */
    public function __construct($rawData)
    {
        parent::__construct($rawData);
    }
}
