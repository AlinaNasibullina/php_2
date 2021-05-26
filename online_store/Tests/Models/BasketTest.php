<?php

namespace Models;

use MyApp\Models\Basket;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    public function testGetTotalSum()
    {
        $basketMockInstance = $this->getBasketRowsMock();

        self::assertEquals(155, $basketMockInstance::getTotalSum(26));
    }

    private function getBasketRowsMock()
    {
        return new class extends Basket {
            public static function getBasketRows($id)
            {
                return [
                    0 => [
                        'basket_id' => 26,
                        'product_id' => 48,
                        'product_count' => 1,
                        'id' => 48,
                        'product_code' => '159',
                        'product_name' => 'Блузка',
                        'product_price' => 45,
                        'product_type' => null,
                        'active' => 1,
                        'img' => 'img_1.png',
                        'product_description' => 'Блузка женская',
                        'product_quantity' => 3,
                    ],
                    1 => [
                        'basket_id' => 26,
                        'product_id' => 47,
                        'product_count' => 2,
                        'id' => 47,
                        'product_code' => '169',
                        'product_name' => 'Рубашка',
                        'product_price' => 55,
                        'product_type' => null,
                        'active' => 1,
                        'img' => 'img_2.png',
                        'product_description' => 'Рубашка женская',
                        'product_quantity' => 3,
                    ]
                ];
            }
        };
    }
}