<?php

namespace UWaterlooAPI\Data;

/**
 * Base class for all API response data models.
 * @package UWaterlooAPI\Data
 */
abstract class APIModel
{
    /**
     * @var string The raw string response returned from the API.
     */
    private $rawData;

    /**
     * APIModel constructor.
     * @param string $rawData Raw data returned from the API.
     */
    public function __construct(string $rawData)
    {
        $this->rawData = $rawData;
    }

    /**
     * Returns the raw data received from the API response.
     * @return string The raw data returned from the API.
     */
    public function getRawData()
    {
        return $this->rawData;
    }
}
