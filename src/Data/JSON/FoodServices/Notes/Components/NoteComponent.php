<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Notes\Components;

use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;

class NoteComponent extends BaseComponent
{
    private $date;
    private $outletName;
    private $outletId;
    private $note;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->date = $this->get(JSONModelConstants::DATE);
        $this->outletName = $this->get(JSONModelConstants::OUTLET_NAME);
        $this->outletId = $this->get(JSONModelConstants::OUTLET_ID);
        $this->note = $this->get(JSONModelConstants::NOTE);
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
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
    public function getOutletId()
    {
        return $this->outletId;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
}
