<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Menu\Components;

use UWaterlooAPI\Data\JSON\Common\Components\ComponentFactory;
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
        $this->date = $this->get(JSONModelConstants::DATE);
        $this->day = $this->get(JSONModelConstants::DAY);
        $this->notes = $this->get(JSONModelConstants::NOTES);
        $this->numMeals = count($this->get(JSONModelConstants::MEALS));
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
        return ComponentFactory::buildComponent($this->get(
            JSONModelConstants::MEALS,
            JSONModelConstants::BREAKFAST
        ), MealComponent::class);
    }

    public function getLunch()
    {
        return ComponentFactory::buildComponent($this->get(
            JSONModelConstants::MEALS,
            JSONModelConstants::LUNCH
        ), MealComponent::class);
    }

    public function getDinner()
    {
        return ComponentFactory::buildComponent($this->get(
            JSONModelConstants::MEALS,
            JSONModelConstants::DINNER
        ), MealComponent::class);
    }
}
