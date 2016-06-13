<?php

namespace UWaterlooAPI\Data\JSON;

use UWaterlooAPI\Data\APIModel;

abstract class JSONModel extends APIModel
{
    private $decodedData;

    public function __construct($data)
    {
        if (is_string($data)) {
            parent::__construct($data);
            $this->decodedData = json_decode($data, true);
        } else {
            $this->decodedData = $data;
            parent::__construct(json_encode($data));
        }
    }

    public function getDecodedData()
    {
        return $this->decodedData;
    }
}
