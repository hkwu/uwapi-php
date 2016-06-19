<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Locations;

use UWaterlooAPI\Data\JSON\Common\BaseModel;
use UWaterlooAPI\Data\JSON\Common\Components\ComponentFactory;
use UWaterlooAPI\Data\JSON\FoodServices\Locations\Components\LocationComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;
use UWaterlooAPI\Utils\ArrayUtil;

class LocationsModel extends BaseModel
{
    private $numLocations;

    public function __construct($rawData)
    {
        parent::__construct($rawData);
        $this->numLocations = count($this->getData());
    }

    /**
     * @return int
     */
    public function getNumLocations()
    {
        return $this->numLocations;
    }

    public function getLocations()
    {
        return ComponentFactory::buildComponents($this->getData(), LocationComponent::class);
    }

    public function getLocationByIndex($index)
    {
        return ComponentFactory::buildComponent($this->getData()[$index], LocationComponent::class);
    }

    public function getOutletById($id)
    {
        $filtered = ArrayUtil::filterByProperty($this->getData(), JSONModelConstants::OUTLET_ID, $id);

        return ComponentFactory::buildComponentArray($filtered, LocationComponent::class);
    }

    public function getOutletByName($name)
    {
        $filtered = ArrayUtil::filterByProperty($this->getData(), JSONModelConstants::OUTLET_NAME, $name);

        return ComponentFactory::buildComponentArray($filtered, LocationComponent::class);
    }
}
