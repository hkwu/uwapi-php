<?php

namespace UWaterlooAPI\Data\JSON\FoodServices\Products\Components;

use UWaterlooAPI\Data\JSON\Common\Components\BaseComponent;
use UWaterlooAPI\Data\JSON\JSONModelConstants;

class ProductComponent extends BaseComponent
{
    private $productId;
    private $productName;
    private $ingredients;
    private $servingSize;
    private $servingSizeMl;
    private $servingSizeG;
    private $calories;
    private $totalFatG;
    private $totalFatPercent;
    private $fatSaturatedG;
    private $fatSaturatedPercent;
    private $fatTransG;
    private $fatTransPercent;
    private $cholesterolMg;
    private $sodiumMg;
    private $sodiumPercent;
    private $carboG;
    private $carboPercent;
    private $carboFibreG;
    private $carboFibrePercent;
    private $carboSugarsG;
    private $proteinG;
    private $vitaminAPercent;
    private $vitaminCPercent;
    private $calciumPercent;
    private $ironPercent;
    private $microNutrients;
    private $tips;
    private $dietId;
    private $dietType;

    public function __construct(array $decodedData)
    {
        parent::__construct($decodedData);
        $this->productId = $this->get(JSONModelConstants::PRODUCT_ID);
        $this->productName = $this->get(JSONModelConstants::PRODUCT_NAME);
        $this->ingredients = $this->get(JSONModelConstants::INGREDIENTS);
        $this->servingSize = $this->get(JSONModelConstants::SERVING_SIZE);
        $this->servingSizeMl = $this->get(JSONModelConstants::SERVING_SIZE_ML);
        $this->servingSizeG = $this->get(JSONModelConstants::SERVING_SIZE_G);
        $this->calories = $this->get(JSONModelConstants::CALORIES);
        $this->totalFatG = $this->get(JSONModelConstants::TOTAL_FAT_G);
        $this->totalFatPercent = $this->get(JSONModelConstants::TOTAL_FAT_PERCENT);
        $this->fatSaturatedG = $this->get(JSONModelConstants::FAT_SATURATED_G);
        $this->fatSaturatedPercent = $this->get(JSONModelConstants::FAT_SATURATED_PERCENT);
        $this->fatTransG = $this->get(JSONModelConstants::FAT_TRANS_G);
        $this->fatTransPercent = $this->get(JSONModelConstants::FAT_TRANS_PERCENT);
        $this->cholesterolMg = $this->get(JSONModelConstants::CHOLESTEROL_MG);
        $this->sodiumMg = $this->get(JSONModelConstants::SODIUM_MG);
        $this->sodiumPercent = $this->get(JSONModelConstants::SODIUM_PERCENT);
        $this->carboG = $this->get(JSONModelConstants::CARBO_G);
        $this->carboPercent = $this->get(JSONModelConstants::CARBO_PERCENT);
        $this->carboFibreG = $this->get(JSONModelConstants::CARBO_FIBRE_G);
        $this->carboFibrePercent = $this->get(JSONModelConstants::CARBO_FIBRE_PERCENT);
        $this->carboSugarsG = $this->get(JSONModelConstants::CARBO_SUGARS_G);
        $this->proteinG = $this->get(JSONModelConstants::PROTEIN_G);
        $this->vitaminAPercent = $this->get(JSONModelConstants::VITAMIN_A_PERCENT);
        $this->vitaminCPercent = $this->get(JSONModelConstants::VITAMIN_C_PERCENT);
        $this->calciumPercent = $this->get(JSONModelConstants::CALCIUM_PERCENT);
        $this->ironPercent = $this->get(JSONModelConstants::IRON_PERCENT);
        $this->microNutrients = $this->get(JSONModelConstants::MICRO_NUTRIENTS);
        $this->tips = $this->get(JSONModelConstants::TIPS);
        $this->dietId = $this->get(JSONModelConstants::DIET_ID);
        $this->dietType = $this->get(JSONModelConstants::DIET_TYPE);
    }

    /**
     * @return int|null
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return string|null
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @return string|null
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @return string|null
     */
    public function getServingSize()
    {
        return $this->servingSize;
    }

    /**
     * @return int|null
     */
    public function getServingSizeMl()
    {
        return $this->servingSizeMl;
    }

    /**
     * @return int|null
     */
    public function getServingSizeG()
    {
        return $this->servingSizeG;
    }

    /**
     * @return int|null
     */
    public function getCalories()
    {
        return $this->calories;
    }

    /**
     * @return int|null
     */
    public function getTotalFatG()
    {
        return $this->totalFatG;
    }

    /**
     * @return int|null
     */
    public function getTotalFatPercent()
    {
        return $this->totalFatPercent;
    }

    /**
     * @return int|null
     */
    public function getFatSaturatedG()
    {
        return $this->fatSaturatedG;
    }

    /**
     * @return int|null
     */
    public function getFatSaturatedPercent()
    {
        return $this->fatSaturatedPercent;
    }

    /**
     * @return int|null
     */
    public function getFatTransG()
    {
        return $this->fatTransG;
    }

    /**
     * @return int|null
     */
    public function getFatTransPercent()
    {
        return $this->fatTransPercent;
    }

    /**
     * @return int|null
     */
    public function getCholesterolMg()
    {
        return $this->cholesterolMg;
    }

    /**
     * @return int|null
     */
    public function getSodiumMg()
    {
        return $this->sodiumMg;
    }

    /**
     * @return int|null
     */
    public function getSodiumPercent()
    {
        return $this->sodiumPercent;
    }

    /**
     * @return int|null
     */
    public function getCarboG()
    {
        return $this->carboG;
    }

    /**
     * @return int|null
     */
    public function getCarboPercent()
    {
        return $this->carboPercent;
    }

    /**
     * @return int|null
     */
    public function getCarboFibreG()
    {
        return $this->carboFibreG;
    }

    /**
     * @return int|null
     */
    public function getCarboFibrePercent()
    {
        return $this->carboFibrePercent;
    }

    /**
     * @return int|null
     */
    public function getCarboSugarsG()
    {
        return $this->carboSugarsG;
    }

    /**
     * @return int|null
     */
    public function getProteinG()
    {
        return $this->proteinG;
    }

    /**
     * @return int|null
     */
    public function getVitaminAPercent()
    {
        return $this->vitaminAPercent;
    }

    /**
     * @return int|null
     */
    public function getVitaminCPercent()
    {
        return $this->vitaminCPercent;
    }

    /**
     * @return int|null
     */
    public function getCalciumPercent()
    {
        return $this->calciumPercent;
    }

    /**
     * @return int|null
     */
    public function getIronPercent()
    {
        return $this->ironPercent;
    }

    /**
     * @return string|null
     */
    public function getMicroNutrients()
    {
        return $this->microNutrients;
    }

    /**
     * @return string|null
     */
    public function getTips()
    {
        return $this->tips;
    }

    /**
     * @return int|null
     */
    public function getDietId()
    {
        return $this->dietId;
    }

    /**
     * @return string|null
     */
    public function getDietType()
    {
        return $this->dietType;
    }
}
