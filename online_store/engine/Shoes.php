<?php
require_once '../engine/Product.php';
class Shoes extends Product 
{
    static $category;
    function __construct($product_code, $product_name, $product_price, $product_description, $product_img, $product_quantity, $product_active = 1)
    {
        parent::__construct($product_code, $product_name, $product_price, $product_description, $product_img, $product_quantity, $product_active = 1);
        $this->category = "обувь";
    }
}