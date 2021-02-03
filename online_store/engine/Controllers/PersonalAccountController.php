<?php

namespace MyApp\Controllers;

use MyApp\Models\PersonalAccount;

class PersonalAccountController extends Controller
{
    public function actionIndex()
    {
        if (empty($_SESSION['user_name'])) {
            // var_dump($_SESSION);
            // var_dump($_POST);
            // var_dump($user);
            header('Location: personalAccount/login');
            // $this->render('login.twig');
            // // exit;
            // $user = PersonalAccount::login($_POST['userName'], $_POST['userPassword']);
            // $_SESSION['user_name'] = $user['user_name'];
            // $_SESSION['user_id'] = $user['id'];

        } else {
            // $this->render('personalAccount.twig', ['user_name' => $_SESSION["user_name"]]);
        }


    }

    public function actionLogin()
    {
        // echo "Хехей!";
        $user = PersonalAccount::login($_POST['userName'], $_POST['userPassword']);
        $_SESSION["user_name"] = $user['user_name'];
        $_SESSION["user_id"] = $user['id'];
        // var_dump($_SESSION);
        // var_dump($_POST);
        // var_dump($user);
        $this->render('personalAccount.twig', ['user_name' => $_SESSION["user_name"], 'user' => $user]);
        
        // $this->render('login.twig');
    }

    public function actionLogout()
    {
        
        unset($_SESSION['user_name']);
        unset($_SESSION['user_id']);

        if(empty($_SESSION['user_name']) && empty($_SESSION['user_id'])){
            $this->render('login.twig');
        }
    }
}