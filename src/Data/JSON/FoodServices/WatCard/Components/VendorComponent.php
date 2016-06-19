<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\WatCard\Components;

use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;

class VendorComponent extends BaseComponent
{
    private $vendorId;
    private $vendorName;
    private $latitude;
    private $longitude;
    private $address;
    private $phoneNumber;
    private $logo;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->vendorId = $this->get(JSONModelConstants::VENDOR_ID);
        $this->vendorName = $this->get(JSONModelConstants::VENDOR_NAME);
        $this->latitude = $this->get(JSONModelConstants::LATITUDE);
        $this->longitude = $this->get(JSONModelConstants::LONGITUDE);
        $this->address = $this->get(JSONModelConstants::ADDRESS);
        $this->phoneNumber = $this->get(JSONModelConstants::PHONE_NUMBER);
        $this->logo = $this->get(JSONModelConstants::LOGO);
    }

    /**
     * @return int|null
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * @return string|null
     */
    public function getVendorName()
    {
        return $this->vendorName;
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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return string|null
     */
    public function getLogo()
    {
        return $this->logo;
    }
}
