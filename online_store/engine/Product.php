<?php
class Product 
{
    protected $product_code;
    protected $product_name;
    protected $product_price;
    protected $product_description;
    protected $product_img;
    protected $product_quantity;
    protected $product_active;
    function __construct($product_code, $product_name, $product_price, $product_description, $product_img, $product_quantity, $product_active = 1) 
    {
        $this->product_code = $product_code;
        $this->product_name = $product_name;
        $this->product_price = $product_price;
        $this->product_description = $product_description;
        $this->product_img = $product_img;
        $this->product_quantity = $product_quantity;
        $this->product_active = $product_active;

    }

    function __get($name) 
    {
        switch ($name) 
        {
            case 'product_code':
                return $this->product_code;
            case 'product_name':
                return $this->product_name;
            case 'product_price':
                return $this->product_price;
            case 'product_description':
                return $this->product_description;
            case 'product_img':
                return $this->product_img;
            case 'product_quantity':
                return $this->product_quantity;
            case 'product_active':
                return $this->product_active;
        }
    }

    function __set($name, $value)
    {
        switch($name) 
        {
            case 'product_code':
                if(is_null($this->product_code) && is_numeric($value))
                {
                    $this->product_code = $value;
                }
            case 'product_name':
                if(is_string($value))
                {
                    $this->product_name = $value;
                }
            case 'product_price':
                if(is_int($value) || is_float($value))
                {
                    $this->product_price = $value;
                }
            case 'product_description':
                if(is_string($value))
                {
                    $this->product_description = $value;
                }
            case 'product_img':
                if(is_string($value))
                {
                    $this->product_img = $value;
                }
            case 'product_quantity':
                if(is_numeric($value))
                {
                    $this->product_quantity = $value;
                }
            case 'product_active':
                if($value == 0 || $value == 1)
                {
                    $this->product_active = $value;
                }
            
        }
    }

}

