<?php
abstract class Product
{
    public $price;
    public $quantity;
    public $unit;
    public $productName;
    
    public function __construct($productName, $price, $quantity, $unit)
    {
        $this->productName = $productName;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->unit = $unit;
    }
    
    abstract public function showCalculateCost(): void;
}