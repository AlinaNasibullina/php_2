<?php
require_once '../engine/Product.php';
define("DIGITAL_PRODUCT_COST", 100);

class DigitalProduct extends Product
{
    public static $cost;

    function __construct($productName, $quantity)
    {
        $this->productName = $productName;
        $this->quantity = $quantity;
        self::$cost = DIGITAL_PRODUCT_COST;
    }

    function calculateCost(): float
    {
        return self::$cost;
    }

    public function showCalculateCost(): void
    {
        echo "Общая стоимость товара " . $this->productName . ": " . $this->calculateCost() . " руб", PHP_EOL;
    }
}
