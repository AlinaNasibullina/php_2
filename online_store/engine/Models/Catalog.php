<?php

namespace MyApp\Models;

use MyApp\Tools\DB;

class Catalog extends Model
{
    const TABEL = 'product';
    private static $imgPath = "../public/img/product_img";

    public static function getImgPath()
    {
        return self::$imgPath;
    }

    public static function getAllProduct()
    {
        return self::db()->getAllActive(self::TABEL);
    }
}
