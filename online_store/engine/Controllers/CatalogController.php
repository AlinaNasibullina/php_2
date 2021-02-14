<?php

namespace MyApp\Controllers;

use MyApp\Models\Catalog;

class CatalogController extends Controller
{
    public function actionIndex()
    {
        $products = Catalog::getAllProduct();

        $this->render('catalog/catalog.twig', ['products' => $products,]);
    }

    public function actionProduct()
    {
        $product = Catalog::getProduct($_GET['id']);
        $imgPath = Catalog::getImgPath();
        if ($product) {
            $this->render('catalog/product.twig', ['product' => $product, 'imgPath' => $imgPath]);
        } else {
            $this->redirect('/');
        }
    }
}