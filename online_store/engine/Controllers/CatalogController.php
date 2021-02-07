<?php

namespace MyApp\Controllers;

use MyApp\Models\Catalog;

class CatalogController extends Controller
{
    public function actionIndex()
    {
        $products = Catalog::getAllProduct();

        $this->render('catalog.twig', ['products' => $products,]);
    }
}