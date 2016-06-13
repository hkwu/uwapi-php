<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Menu\Components;

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
        return array_map(function ($element) {
            return new ProductComponent($element);
        }, $this->getDecodedData());
    }

    public function getProductByIndex($index)
    {
        // todo exceptions
        return new ProductComponent($this->getDecodedData()[$index]);
    }

    public function getProductByName($name)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getDecodedData(),
            JSONModelConstants::PRODUCT_NAME,
            $name
        );
        
        return new ProductComponent(reset($filtered));
    }

    public function getProductById($id)
    {
        $filtered = ArrayUtil::filterByProperty(
            $this->getDecodedData(),
            JSONModelConstants::PRODUCT_ID,
            $id
        );
        
        return new ProductComponent(reset($filtered));
    }
}
