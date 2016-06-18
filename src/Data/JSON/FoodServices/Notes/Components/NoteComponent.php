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
        $this->date = $decodedData[JSONModelConstants::DATE];
        $this->outletName = $decodedData[JSONModelConstants::OUTLET_NAME];
        $this->outletId = $decodedData[JSONModelConstants::OUTLET_ID];
        $this->note = $decodedData[JSONModelConstants::NOTE];
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
