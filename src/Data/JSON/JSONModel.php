<?php

namespace UWaterlooAPI\Data\JSON;
use UWaterlooAPI\Data\APIModel;
use UWaterlooAPI\Utils\ArrayUtil;

/**
 * Class that wraps data returned in JSON format.
 * @package UWaterlooAPI\Data\JSON
 */
class JSONModel extends APIModel
{
    const META = 'meta';
    const DATA = 'data';

    /**
     * @var array The decoded JSON value of the API response.
     */
    private $decodedData;

    /**
     * JSONModel constructor.
     * @param string $data The raw JSON API response.
     */
    public function __construct(string $data)
    {
        parent::__construct($data);

        $this->decodedData = json_decode($data, true);
    }

    /**
     * Returns the decoded JSON from the API response.
     * @return array The decoded JSON from the API response.
     */
    public function getDecodedData(): array
    {
        return $this->decodedData;
    }

    /**
     * Returns the value of the 'meta' section of the response data.
     * @return array The 'meta' section of the API response.
     */
    public function getMeta(): array
    {
        return $this->get(self::META);
    }

    /**
     * Returns the value of the 'data' section of the response data.
     * @return array The 'data' section of the API response.
     */
    public function getData(): array
    {
        return $this->get(self::DATA);
    }

    /**
     * Wrapper method to return data from the model's decoded JSON.
     *
     * @param array $keys Set of keys to access the decoded data.
     *
     * @return mixed Returns value if found, else null.
     */
    public function get(...$keys)
    {
        return ArrayUtil::getVal($this->decodedData, $keys);
    }
}
