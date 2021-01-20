<?php
//require '../engine/Product.php';
require_once '../engine/PhisicalProduct.php';
require_once '../engine/DigitalProduct.php';
require_once '../engine/WeightProduct.php';

$p = new PhisicalProduct("книги", 20, 2, "шт.");
$d = new DigitalProduct("видеокурс", 5);
$w = new WeightProduct("вишня", 10, 2.5, "кг");

$p->showCalculateCost();
$d->showCalculateCost();
$w->showCalculateCost();
