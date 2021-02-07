<?php

namespace MyApp\Models;

use MyApp\Auth;
use MyApp\Tools\DB;

class Basket extends Model
{
    const TABEL = 'baskets';
    const TABEL_DETAILS = 'basket_items';
    const TABEL_PRODUCT = 'product';

    public static function getTotalSum($basket_id)
    {
        $basket = self::getBasketRows($basket_id);
        $totalSum = 0;
        foreach($basket as $item) {
            $totalSum += ($item['product_count'] * $item['product_price']);
        }
        return $totalSum;
    }
    public static function getBasket($user_id = null)
    {
        return self::db()->getOneRow(self::TABEL, 'user_id', $user_id);
    }

    public static function getBasketRows($basket_id)
    {
        return self::link()->query('SELECT * FROM ' . self::TABEL_DETAILS . ' i LEFT JOIN ' . self::TABEL_PRODUCT . ' p ON p.id = i.product_id WHERE i.basket_id = ' . $basket_id)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function addBasket($user_id) {

    }
    public static function add($product_id)
    {
        if (Auth::getUser()) {
            if ($basket_id = self::getBasket($_SESSION['user_id'])['id']) {
                self::link()->query('INSERT INTO ' . self::TABEL_DETAILS
                . ' (basket_id, product_id, product_count)
                VALUES (' . $basket_id . ', ' . $product_id .', 1) 
                ON DUPLICATE KEY UPDATE product_count = product_count + 1')->fetch(\PDO::FETCH_ASSOC);
                return true;
            } else {
                self::db()->addRow(self::TABEL, 'user_id', $_SESSION['user_id']);
                self::add($product_id); //рекурсия не работает, корзину доработать TODO
            }
        } else {
            return false;
        }
    }

    public static function delete($product_id)
    {
        $basket_id = self::getBasket($_SESSION['user_id'])['id'];
        self::link()->query('DELETE FROM ' . self::TABEL_DETAILS .
        ' WHERE basket_id = ' . $basket_id . ' AND product_id = ' . $product_id);
        self::getBasketRows($basket_id);
    }
    // private static function addBasket($column_name, $column_value)
    // {
    //     self::link();
    // }

}