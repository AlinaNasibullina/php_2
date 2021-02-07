<?php

namespace MyApp\Controllers;

use MyApp\Models\PersonalAccount;
use MyApp\Models\Admin;

class AdminController extends Controller
{
    public function actionIndex()
    {
        if (PersonalAccount::checkUserRole($_SESSION['user_id'])) {
            $this->render('admin/admin.twig');
        } else {
            $this->redirect('/');
        }

    }

    public function actionOrders()
    {
        if (PersonalAccount::checkUserRole($_SESSION['user_id'])) {
            $orders = Admin::getOrders();
            foreach($orders as $order)
            {
                $order_details[] = Admin::getOrderDetails($order['id']);
            }
            // var_dump($order_details);
            $this->render('admin/orders.twig', [
                'orders' => $orders,
                'order_details' => $order_details,
            ]);
        } else {
            $this->redirect('/');
        }
    }

    public function actionChange()
    {
        switch ($_GET['action']) {
            case 'cancel':
                Admin::cancelOrder($_GET['id']);
                $this->redirect('orders');
                break;
            case 'accept':
                Admin::acceptOrder($_GET['id']);
                $this->redirect('orders');
                break;
            case 'send':
                Admin::sendOrder($_GET['id']);
                $this->redirect('orders');
                break;
        }
    }
}