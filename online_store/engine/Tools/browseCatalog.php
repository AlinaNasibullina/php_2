<?php

namespace myApp\Tools;
require './vendor/autoload.php';

use myApp\Tools\DB;

$count = $_POST['count'];
$browseCount = 1;
$first_row = 0;
$last_row = 2;

if ($count == 1) {
    $browseCount++;
    $first_row = $last_row;
    $last_row *= $browseCount;

    $result = DB::getInstance()->getAllActive(DB::PRODUCT_TABEL, $first_row, $last_row);
    $products = [];
    foreach ($result as $row) {
        $products[] = $row;
    }
    if (empty($products)) {
        var_dump($products);
        // echo "все загружено";
    } else {
        echo json_encode($products);
    }
} else {
    
}

