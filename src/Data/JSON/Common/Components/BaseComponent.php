<?php

namespace UWaterlooAPI\Data\JSON\Common\Components;

use UWaterlooAPI\Data\JSON\JSONModel;

abstract class BaseComponent extends JSONModel
{
    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
    }
}
