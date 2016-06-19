<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Menu\Components;

use UWaterlooAPI\Data\JSON\Common\ComponentFactory;
use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;
use UWaterlooAPI\Utils\ArrayUtil;

class MealComponent extends BaseComponent
{
    private $numProducts;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->numProducts = count($decodedData);
    }

    public function getNumProducts()
    {
        return $this->numProducts;
    }

    public function getProducts()
    {
        return ComponentFactory::buildComponents($this->getDecodedData(), ProductComponent::class);
    }

    public function getProductByIndex($index)
    {
        return ComponentFactory::buildComponent($this->getDecodedData()[$index], ProductComponent::class);
    }

    public function getProductByName($name)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getDecodedData(),
            JSONModelConstants::PRODUCT_NAME,
            $name
        );

        return ComponentFactory::buildComponentArray($filtered, ProductComponent::class);
    }

    public function getProductById($id)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getDecodedData(),
            JSONModelConstants::PRODUCT_ID,
            $id
        );

        return ComponentFactory::buildComponentArray($filtered, ProductComponent::class);
    }
}
