<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Announcements;

use UWaterlooAPI\Data\JSON\Common\BaseModel;
use UWaterlooAPI\Data\JSON\Common\Components\ComponentFactory;
use UWaterlooAPI\Data\JSON\FoodServices\Announcements\Components\AnnouncementComponent;

class AnnouncementsModel extends BaseModel
{
    private $numAnnouncements;
    
    public function __construct($rawData)
    {
        parent::__construct($rawData);
        $this->numAnnouncements = count($this->getData());
    }

    /**
     * @return int
     */
    public function getNumAnnouncements()
    {
        return $this->numAnnouncements;
    }
    
    public function getAnnouncementByIndex($index)
    {
        return ComponentFactory::buildComponent($this->getData()[$index], AnnouncementComponent::class);
    }
    
    public function getAnnouncements()
    {
        return ComponentFactory::buildComponents($this->getData(), AnnouncementComponent::class);
    }
}
