<?php

namespace MyApp\Controllers;

use MyApp\Auth;
use MyApp\Models\PersonalAccount;

class PersonalAccountController extends Controller
{
    public function actionIndex()
    {
        
        if (empty(Auth::getUser())) {
            $this->redirect('login');
        } else {
            $this->render('account/personalAccount.twig', ['user_name' => Auth::getUser()]);
        }


    }

    public function actionLogin()
    {
        $error = false;
        if(empty(Auth::getUser())) {
            if (PersonalAccount::checkUser($_POST['userName'], $_POST['userPassword'])) {
                Auth::login();
                $this->redirect('personalAccount');
            } else {
                $error = true;
                $this->render('account/login.twig', ['error' => $error]);
            }
        } else {
            $this->redirect('personalAccount');
        }
        
    }

    public function actionLogout()
    {
        Auth::logout();

        $this->redirect('/');
    }
}