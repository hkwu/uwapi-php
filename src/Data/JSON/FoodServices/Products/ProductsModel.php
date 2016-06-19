<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Products;

use UWaterlooAPI\Data\JSON\Common\BaseModel;
use UWaterlooAPI\Data\JSON\Common\Components\ComponentFactory;
use UWaterlooAPI\Data\JSON\FoodServices\Products\Components\ProductComponent;

class ProductsModel extends BaseModel
{
    public function __construct($rawData)
    {
        parent::__construct($rawData);
    }

    public function getProduct()
    {
        return ComponentFactory::buildComponent($this->getData(), ProductComponent::class);
    }
}
