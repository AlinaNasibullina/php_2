<?php

namespace MyApp\Controllers;

use MyApp\Auth;
use MyApp\Models\Basket;

class BasketController extends Controller
{
    public function actionIndex()
    {
        $basket = Basket::getBasket($_SESSION['user_id']);
        if ($basket) {
            $basket_details = Basket::getBasketRows($basket['id']);
            $totalSum = Basket::getTotalSum($basket['id']);
            $this->render('account/basket.twig', [
                'basket' => $basket,
                'basket_details' => $basket_details,
                'totalSum' => $totalSum,
            ]);
        } else {
            $this->render('account/basket.twig');
        }
    }

    public function actionAdd()
    {
        if (Auth::getUser()) {
            if ($a = Basket::add($_GET['id'])) {
                // var_dump($a);
                // var_dump(Auth::getUser());
                // var_dump($_SERVER['HTTP_REFERER'] . '#' . $_GET['id']);
                echo($_SERVER['HTTP_REFERER'] . '#' . $_GET['id']);
                // $this->redirect($_SERVER['HTTP_REFERER'] . '#' . $_GET['id']);
            } else {
                echo "не удалось добавить товар в корзину";
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function actionDelete()
    {
        Basket::delete($_GET['id']);
        $this->redirect('/basket');
    }
}