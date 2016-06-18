<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Outlets;

use UWaterlooAPI\Data\JSON\Common\BaseModel;
use UWaterlooAPI\Data\JSON\FoodServices\Outlets\Components\OutletComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;
use UWaterlooAPI\Utils\ArrayUtil;

class OutletsModel extends BaseModel
{
    private $numOutlets;

    public function __construct($rawData)
    {
        parent::__construct($rawData);
        $this->numOutlets = count($this->getData());
    }

    /**
     * @return int
     */
    public function getNumOutlets()
    {
        return $this->numOutlets;
    }

    public function getOutlets()
    {
        return array_map(function ($element) {
            return new OutletComponent($element);
        }, $this->getData());
    }

    public function getOutletByIndex($index)
    {
        return $this->getData()[$index];
    }

    public function getOutletById($id)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getData(),
            JSONModelConstants::OUTLET_ID,
            $id
        );

        return new OutletComponent(reset($filtered));
    }
    
    public function getOutletByName($name)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getData(),
            JSONModelConstants::OUTLET_NAME,
            $name
        );

        return new OutletComponent(reset($filtered));
    }
}
