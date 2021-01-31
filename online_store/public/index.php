<?php

// namespace myApp;
require './vendor/autoload.php';
// require '../vendor/autoload.php';
// require './engine/Tools/DB.php';
// use myApp\engine\Tools\DB\DB;
use myApp\engine\Tools\DB;

$loader = new \Twig\Loader\FilesystemLoader('./public/templates');
$twig = new \Twig\Environment($loader);

$imgPath = "../public/img/product_img";
$products = [];
$result = DB::getInstance()->getAllActive(DB::PRODUCT_TABEL);

foreach ($result as $row) {
    $products[] = $row;
}

echo $twig->render('index.twig', [
    'products' => $products,
    'imgPath' => $imgPath,
]);
