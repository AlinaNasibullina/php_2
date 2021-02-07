<?php

namespace MyApp\Controllers;
use MyApp\Models\Catalog;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $products = Catalog::getAllProduct();
        $imgPath = Catalog::getImgPath();

        $this->render('index.twig', [
            'products' => $products,
            'imgPath' => $imgPath,    
        ]);
    }

    public function actionError()
    {
        $this->render('error.twig');
    }
}