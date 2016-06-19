<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Locations\Components;

use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;

class SpecialHoursComponent extends BaseComponent
{
    private $date;
    private $openingHour;
    private $closingHour;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->date = $this->get(JSONModelConstants::DATE);
        $this->openingHour = $this->get(JSONModelConstants::OPENING_HOUR);
        $this->closingHour = $this->get(JSONModelConstants::CLOSING_HOUR);
    }

    /**
     * @return string|null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string|null
     */
    public function getOpeningHour()
    {
        return $this->openingHour;
    }

    /**
     * @return string|null
     */
    public function getClosingHour()
    {
        return $this->closingHour;
    }
}
