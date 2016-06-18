<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Diets\Components;

use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;

class DietComponent extends BaseComponent
{
    private $dietId;
    private $dietType;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->dietId = $decodedData[JSONModelConstants::DIET_ID];
        $this->dietType = $decodedData[JSONModelConstants::DIET_TYPE];
    }

    /**
     * @return mixed
     */
    public function getDietId()
    {
        return $this->dietId;
    }

    /**
     * @return mixed
     */
    public function getDietType()
    {
        return $this->dietType;
    }
}
