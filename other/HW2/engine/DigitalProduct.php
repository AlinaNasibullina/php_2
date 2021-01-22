<?php

class DigitalProduct extends Product
{
    public static $cost;
    const DIGITAL_PRODUCT_COST = 100;

    function __construct($productName, $quantity)
    {
        $this->productName = $productName;
        $this->quantity = $quantity;
        self::$cost = self::DIGITAL_PRODUCT_COST;
    }

    function calculateCost(): float
    {
        return self::$cost;
    }

    public function showCalculateCost(): void
    {
        echo "Общая стоимость товара " . $this->productName . 
        ": " . $this->calculateCost() . " руб", PHP_EOL;
    }
}
