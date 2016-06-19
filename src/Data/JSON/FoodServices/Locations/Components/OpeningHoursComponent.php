<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Locations\Components;

use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;

class OpeningHoursComponent extends BaseComponent
{
    private $openingHour;
    private $closingHour;
    private $isClosed;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->openingHour = $this->get(JSONModelConstants::OPENING_HOUR);
        $this->closingHour = $this->get(JSONModelConstants::CLOSING_HOUR);
        $this->isClosed = $this->get(JSONModelConstants::IS_CLOSED);
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

    /**
     * @return bool|null
     */
    public function getIsClosed()
    {
        return $this->isClosed;
    }
}
