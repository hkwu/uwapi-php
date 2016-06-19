<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Menu\Components;

use UWaterlooAPI\Data\JSON\Common\ComponentFactory;
use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;
use UWaterlooAPI\Utils\ArrayUtil;

class MenuComponent extends BaseComponent
{
    private $date;
    private $day;
    private $notes;
    private $numMeals;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->date = $decodedData[JSONModelConstants::DATE];
        $this->day = $decodedData[JSONModelConstants::DAY];
        $this->notes = $decodedData[JSONModelConstants::NOTES];
        $this->numMeals = count($decodedData[JSONModelConstants::MEALS]);
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function getNumMeals()
    {
        return $this->numMeals;
    }

    public function getBreakfast()
    {
        return ComponentFactory::buildComponent(ArrayUtil::getVal(
            $this->getDecodedData(),
            JSONModelConstants::MEALS,
            JSONModelConstants::BREAKFAST
        ), MealComponent::class);
    }

    public function getLunch()
    {
        return ComponentFactory::buildComponent(ArrayUtil::getVal(
            $this->getDecodedData(),
            JSONModelConstants::MEALS,
            JSONModelConstants::LUNCH
        ), MealComponent::class);
    }

    public function getDinner()
    {
        return ComponentFactory::buildComponent(ArrayUtil::getVal(
            $this->getDecodedData(),
            JSONModelConstants::MEALS,
            JSONModelConstants::DINNER
        ), MealComponent::class);
    }
}
