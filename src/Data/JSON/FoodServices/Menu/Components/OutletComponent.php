<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Menu\Components;

use UWaterlooAPI\Data\JSON\Common\ComponentFactory;
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
        $this->outletName = $decodedData[JSONModelConstants::OUTLET_NAME];
        $this->outletId = $decodedData[JSONModelConstants::OUTLET_ID];
        $this->numMenus = count($decodedData[JSONModelConstants::MENU]);
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
        return array_map(function ($element) {
            return new MenuComponent($element);
        }, $this->getDecodedData()[JSONModelConstants::MENU]);
    }

    public function getMenuByIndex($index)
    {
        return new MenuComponent(ArrayUtil::getVal($this->getDecodedData(), JSONModelConstants::MENU, $index));
    }

    public function getMenuByDay($day)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getDecodedData()[JSONModelConstants::MENU],
            JSONModelConstants::DAY,
            $day
        );

        return ComponentFactory::buildComponent($filtered, MenuComponent::class);
    }
}
