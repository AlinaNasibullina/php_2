<?php

namespace MyApp\Controllers;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $this->render('index.twig');
    }

    public function actionError()
    {
        $this->render('error.twig');
    }
}