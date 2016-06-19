<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Diets;

use UWaterlooAPI\Data\JSON\Common\BaseModel;
use UWaterlooAPI\Data\JSON\Common\ComponentFactory;
use UWaterlooAPI\Data\JSON\FoodServices\Diets\Components\DietComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;
use UWaterlooAPI\Utils\ArrayUtil;

class DietsModel extends BaseModel
{
    private $numDiets;

    public function __construct($rawData)
    {
        parent::__construct($rawData);
        $this->numDiets = count($this->getData());
    }

    /**
     * @return int
     */
    public function getNumDiets()
    {
        return $this->numDiets;
    }

    public function getDiets()
    {
        return ComponentFactory::buildComponents($this->getData(), DietComponent::class);
    }

    public function getDietByIndex($index)
    {
        return $this->getData()[$index];
    }

    public function getDietById($id)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getData(),
            JSONModelConstants::DIET_ID,
            $id
        );

        return ComponentFactory::buildComponent($filtered, DietComponent::class);
    }

    public function getDietByType($id)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getData(),
            JSONModelConstants::DIET_TYPE,
            $id
        );

        return ComponentFactory::buildComponent($filtered, DietComponent::class);
    }
}
