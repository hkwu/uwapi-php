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
        $this->numOutlets = count($this->get(JSONModelConstants::DATA, JSONModelConstants::OUTLETS));
    }

    public function getDate()
    {
        return ComponentFactory::buildComponent(
            $this->get(JSONModelConstants::DATA, JSONModelConstants::DATE), 
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
            $this->get(JSONModelConstants::DATA, JSONModelConstants::OUTLETS),
            OutletComponent::class
        );
    }

    public function getOutletByIndex($index)
    {
        return ComponentFactory::buildComponent(
            $this->get(JSONModelConstants::DATA, JSONModelConstants::OUTLETS, $index),
            OutletComponent::class
        );
    }

    public function getOutletById($id)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->get(JSONModelConstants::DATA, JSONModelConstants::OUTLETS),
            JSONModelConstants::OUTLET_ID,
            $id
        );

        return ComponentFactory::buildComponentArray($filtered, OutletComponent::class);
    }

    public function getOutletByName($name)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->get(JSONModelConstants::DATA, JSONModelConstants::OUTLETS),
            JSONModelConstants::OUTLET_NAME,
            $name
        );

        return ComponentFactory::buildComponentArray($filtered, OutletComponent::class);
    }
}
