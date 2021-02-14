<?php

namespace MyApp\Models;

use MyApp\Tools\DB;

class Catalog extends Model
{
    const TABEL = 'product';
    private static $imgPath = "/img/product_img";

    public static function getImgPath()
    {
        return self::$imgPath;
    }

    public static function getAllProduct()
    {
        return self::db()->getAllActive(self::TABEL);
    }

    public static function getProduct($id)
    {
        return self::db()->getOneActive(self::TABEL, $id);
    }
}
