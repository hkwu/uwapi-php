<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Menu;

use UWaterlooAPI\Data\JSON\Common\BaseModel;
use UWaterlooAPI\Data\JSON\FoodServices\Menu\Components\DateComponent;
use UWaterlooAPI\Data\JSON\FoodServices\Menu\Components\OutletComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;
use UWaterlooAPI\Utils\ArrayUtil;

class MenuModel extends BaseModel
{
    private $numOutlets;

    public function __construct($rawData)
    {
        parent::__construct($rawData);
        $this->numOutlets = count($this->getData()[JSONModelConstants::OUTLETS]);
    }

    public function getDate()
    {
        return new DateComponent($this->getData()[JSONModelConstants::DATE]);
    }

    public function getNumOutlets()
    {
        return $this->numOutlets;
    }

    public function getOutlets()
    {
        return array_map(function ($element) {
            return new OutletComponent($element);
        }, $this->getData()[JSONModelConstants::OUTLETS]);
    }

    public function getOutletByIndex($index)
    {
        return new OutletComponent(ArrayUtil::getVal($this->getData(), JSONModelConstants::OUTLETS, $index));
    }

    public function getOutletById($id)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getData()[JSONModelConstants::OUTLETS],
            JSONModelConstants::OUTLET_ID,
            $id
        );

        return new OutletComponent(reset($filtered));
    }

    public function getOutletByName($name)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getData()[JSONModelConstants::OUTLETS],
            JSONModelConstants::OUTLET_NAME,
            $name
        );

        return new OutletComponent(reset($filtered));
    }
}
