<?php

error_reporting(E_ALL & ~E_NOTICE);

require './vendor/autoload.php';

\MyApp\App::getInstance()
    ->setConfig(require './config/main.php') //проверить пути, настройки
    ->run();
// use myApp\Tools\DB;

// $loader = new \Twig\Loader\FilesystemLoader();
// $twig = new \Twig\Environment($loader);

// $imgPath = "../public/img/product_img";
// $products = [];
// $result = DB::getInstance()->getAllActive(DB::PRODUCT_TABEL);

// foreach ($result as $row) {
//     $products[] = $row;
// }

// echo $twig->render('index.twig', [
//     'products' => $products,
//     'imgPath' => $imgPath,
// ]);
