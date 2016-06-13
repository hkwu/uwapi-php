<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Menu\Components;

use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;

class ProductComponent extends BaseComponent
{
    private $productName;
    private $productId;
    private $dietType;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->productName = $decodedData[JSONModelConstants::PRODUCT_NAME];
        $this->productId = $decodedData[JSONModelConstants::PRODUCT_ID];
        $this->dietType = $decodedData[JSONModelConstants::DIET_TYPE];
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getDietType()
    {
        return $this->dietType;
    }
}
