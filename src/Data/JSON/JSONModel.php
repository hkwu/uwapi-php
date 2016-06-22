<?php

namespace UWaterlooAPI\Data\JSON;

use UWaterlooAPI\Data\APIModel;
use UWaterlooAPI\Utils\ArrayUtil;

abstract class JSONModel extends APIModel
{
    private $decodedData;

    public function __construct($data)
    {
        if (is_string($data)) {
            parent::__construct($data);
            $this->decodedData = json_decode($data, true);
        } else {
            parent::__construct(json_encode($data));
            $this->decodedData = $data;
        }
    }

    public function getDecodedData()
    {
        return $this->decodedData;
    }

    /**
     * Wrapper method to return data from the model's decoded JSON.
     *
     * @param array ...$keys Set of keys to access the decoded data.
     *
     * @return mixed|null Returns value if found, else null.
     */
    public function get(...$keys)
    {
        return ArrayUtil::getVal($this->decodedData, $keys);
    }
}
