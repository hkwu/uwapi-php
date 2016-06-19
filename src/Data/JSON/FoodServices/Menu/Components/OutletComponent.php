<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Menu\Components;

use UWaterlooAPI\Data\JSON\Common\Components\ComponentFactory;
use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;
use UWaterlooAPI\Utils\ArrayUtil;

class OutletComponent extends BaseComponent
{
    private $outletName;
    private $outletId;
    private $numMenus;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->outletName = $this->get(JSONModelConstants::OUTLET_NAME);
        $this->outletId = $this->get(JSONModelConstants::OUTLET_ID);
        $this->numMenus = count($this->get(JSONModelConstants::MENU));
    }

    public function getOutletName()
    {
        return $this->outletName;
    }

    public function getOutletId()
    {
        return $this->outletId;
    }

    public function getNumMenus()
    {
        return $this->numMenus;
    }

    public function getMenus()
    {
        return ComponentFactory::buildComponents(
            $this->get(JSONModelConstants::MENU),
            MenuComponent::class
        );
    }

    public function getMenuByIndex($index)
    {
        return ComponentFactory::buildComponent(
            $this->get(JSONModelConstants::MENU, $index),
            MenuComponent::class
        );
    }

    public function getMenuByDay($day)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->get(JSONModelConstants::MENU),
            JSONModelConstants::DAY,
            $day
        );

        return ComponentFactory::buildComponentArray($filtered, MenuComponent::class);
    }
}
