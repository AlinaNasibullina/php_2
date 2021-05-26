<?php
require_once '../engine/Product.php';

class WeightProduct extends Product
{
    public function calculateCost (): float 
    {
        return $this->price * $this->quantity;
    }

    public function showCalculateCost(): void
    {
        echo "Общая стоимость товара " . $this->productName . ": " . $this->price . " руб * " . $this->quantity . " " . $this->unit . " = " . $this->calculateCost() . " руб", PHP_EOL;
    }

}
