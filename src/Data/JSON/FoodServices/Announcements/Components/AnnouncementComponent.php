<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Announcements\Components;

use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;

class AnnouncementComponent extends BaseComponent
{
    private $date;
    private $adText;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->date = $this->get(JSONModelConstants::DATE);
        $this->adText = $this->get(JSONModelConstants::AD_TEXT);
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
    public function getAdText()
    {
        return $this->adText;
    }
}
