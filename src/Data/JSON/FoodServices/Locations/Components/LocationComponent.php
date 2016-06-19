<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Locations\Components;

use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\Common\Components\ComponentFactory;
use UWaterlooAPI\Data\JSON\JSONModelConstants;

class LocationComponent extends BaseComponent
{
    private $outletId;
    private $outletName;
    private $building;
    private $logo;
    private $latitude;
    private $longitude;
    private $description;
    private $notice;
    private $isOpenNow;
    private $is24Hrs;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->outletId = $this->get(JSONModelConstants::OUTLET_ID);
        $this->outletName = $this->get(JSONModelConstants::OUTLET_NAME);
        $this->building = $this->get(JSONModelConstants::BUILDING);
        $this->logo = $this->get(JSONModelConstants::LOGO);
        $this->latitude = $this->get(JSONModelConstants::LATITUDE);
        $this->longitude = $this->get(JSONModelConstants::LONGITUDE);
        $this->description = $this->get(JSONModelConstants::DESCRIPTION);
        $this->notice = $this->get(JSONModelConstants::NOTICE);
        $this->isOpenNow = $this->get(JSONModelConstants::IS_OPEN_NOW);
        $this->is24Hrs = $this->get(JSONModelConstants::IS_24_HRS);
    }

    /**
     * @return int|null
     */
    public function getOutletId()
    {
        return $this->outletId;
    }

    /**
     * @return string|null
     */
    public function getOutletName()
    {
        return $this->outletName;
    }

    /**
     * @return string|null
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * @return string|null
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @return float|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return float|null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getNotice()
    {
        return $this->notice;
    }

    /**
     * @return bool|null
     */
    public function getIsOpenNow()
    {
        return $this->isOpenNow;
    }

    /**
     * @return bool|null
     */
    public function getIs24Hrs()
    {
        return $this->is24Hrs;
    }

    public function getSundayHours()
    {
        return ComponentFactory::buildComponent(
            $this->get(JSONModelConstants::OPENING_HOURS, JSONModelConstants::SUNDAY),
            OpeningHoursComponent::class
        );
    }

    public function getMondayHours()
    {
        return ComponentFactory::buildComponent(
            $this->get(JSONModelConstants::OPENING_HOURS, JSONModelConstants::MONDAY),
            OpeningHoursComponent::class
        );
    }

    public function getTuesdayHours()
    {
        return ComponentFactory::buildComponent(
            $this->get(JSONModelConstants::OPENING_HOURS, JSONModelConstants::TUESDAY),
            OpeningHoursComponent::class
        );
    }

    public function getWednesdayHours()
    {
        return ComponentFactory::buildComponent(
            $this->get(JSONModelConstants::OPENING_HOURS, JSONModelConstants::WEDNESDAY),
            OpeningHoursComponent::class
        );
    }

    public function getThursdayHours()
    {
        return ComponentFactory::buildComponent(
            $this->get(JSONModelConstants::OPENING_HOURS, JSONModelConstants::THURSDAY),
            OpeningHoursComponent::class
        );
    }

    public function getFridayHours()
    {
        return ComponentFactory::buildComponent(
            $this->get(JSONModelConstants::OPENING_HOURS, JSONModelConstants::FRIDAY),
            OpeningHoursComponent::class
        );
    }

    public function getSaturdayHours()
    {
        return ComponentFactory::buildComponent(
            $this->get(JSONModelConstants::OPENING_HOURS, JSONModelConstants::SATURDAY),
            OpeningHoursComponent::class
        );
    }

    public function getSpecialHours()
    {
        return ComponentFactory::buildComponents(
            $this->get(JSONModelConstants::SPECIAL_HOURS),
            SpecialHoursComponent::class
        );
    }

    public function getDatesClosed()
    {
        return $this->get(JSONModelConstants::DATES_CLOSED);
    }

    public function getAdditional()
    {
        return $this->get(JSONModelConstants::ADDITIONAL);
    }
}
