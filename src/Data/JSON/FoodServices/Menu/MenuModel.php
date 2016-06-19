<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Menu;

use UWaterlooAPI\Data\JSON\Common\BaseModel;
use UWaterlooAPI\Data\JSON\Common\ComponentFactory;
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
        return ComponentFactory::buildComponent(
            $this->getData()[JSONModelConstants::DATE], 
            DateComponent::class
        );
    }

    public function getNumOutlets()
    {
        return $this->numOutlets;
    }

    public function getOutlets()
    {
        return ComponentFactory::buildComponents(
            $this->getData()[JSONModelConstants::OUTLETS],
            OutletComponent::class
        );
    }

    public function getOutletByIndex($index)
    {
        return ComponentFactory::buildComponent(
            ArrayUtil::getVal($this->getData(), JSONModelConstants::OUTLETS, $index), 
            OutletComponent::class
        );
    }

    public function getOutletById($id)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getData()[JSONModelConstants::OUTLETS],
            JSONModelConstants::OUTLET_ID,
            $id
        );

        return ComponentFactory::buildComponentArray($filtered, OutletComponent::class);
    }

    public function getOutletByName($name)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getData()[JSONModelConstants::OUTLETS],
            JSONModelConstants::OUTLET_NAME,
            $name
        );

        return ComponentFactory::buildComponentArray($filtered, OutletComponent::class);
    }
}
