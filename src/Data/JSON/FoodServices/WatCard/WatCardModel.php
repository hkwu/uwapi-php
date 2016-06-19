<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\WatCard;

use UWaterlooAPI\Data\JSON\Common\BaseModel;
use UWaterlooAPI\Data\JSON\Common\Components\ComponentFactory;
use UWaterlooAPI\Data\JSON\FoodServices\WatCard\Components\VendorComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;
use UWaterlooAPI\Utils\ArrayUtil;

class WatCardModel extends BaseModel
{
    private $numVendors;

    public function __construct($rawData)
    {
        parent::__construct($rawData);
        $this->numVendors = count($this->getData());
    }

    /**
     * @return int
     */
    public function getNumVendors()
    {
        return $this->numVendors;
    }

    public function getVendorByIndex($index)
    {
        return ComponentFactory::buildComponent($this->getData()[$index], VendorComponent::class);
    }

    public function getVendorById($id)
    {
        $filtered = ArrayUtil::filterByProperty($this->getData(), JSONModelConstants::VENDOR_ID, $id);

        return ComponentFactory::buildComponentArray($filtered, VendorComponent::class);
    }

    public function getVendorByName($name)
    {
        $filtered = ArrayUtil::filterByProperty($this->getData(), JSONModelConstants::VENDOR_NAME, $name);

        return ComponentFactory::buildComponentArray($filtered, VendorComponent::class);
    }

    public function getVendors()
    {
        return ComponentFactory::buildComponents($this->getData(), VendorComponent::class);
    }
}
