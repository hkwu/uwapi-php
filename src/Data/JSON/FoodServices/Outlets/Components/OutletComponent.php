<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Outlets\Components;

use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;

class OutletComponent extends BaseComponent
{
    private $outletId;
    private $outletName;
    private $hasBreakfast;
    private $hasLunch;
    private $hasDinner;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->outletId = $decodedData[JSONModelConstants::OUTLET_ID];
        $this->outletName = $decodedData[JSONModelConstants::OUTLET_NAME];
        $this->hasBreakfast = $decodedData[JSONModelConstants::HAS_BREAKFAST];
        $this->hasLunch = $decodedData[JSONModelConstants::HAS_LUNCH];
        $this->hasDinner = $decodedData[JSONModelConstants::HAS_DINNER];
    }

    /**
     * @return int
     */
    public function getOutletId()
    {
        return $this->outletId;
    }

    /**
     * @return string
     */
    public function getOutletName()
    {
        return $this->outletName;
    }

    /**
     * @return int
     */
    public function getHasBreakfast()
    {
        return $this->hasBreakfast;
    }

    /**
     * @return int
     */
    public function getHasLunch()
    {
        return $this->hasLunch;
    }

    /**
     * @return int
     */
    public function getHasDinner()
    {
        return $this->hasDinner;
    }
}
