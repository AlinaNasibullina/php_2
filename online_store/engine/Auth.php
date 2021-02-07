<?php

namespace MyApp;

use MyApp\Models\PersonalAccount;

class Auth
{
    public static function getUser()
    {
        return $_SESSION['user_name'];
    }

    public static function login()
    {   
        $user = PersonalAccount::getUser($_POST['userName'], $_POST['userPassword']);
        $_SESSION["user_name"] = $user['user_name'];
        $_SESSION["user_id"] = $user['id'];
    }

    public static function logout()
    {
        unset($_SESSION['user_name']);
        unset($_SESSION['user_id']);
    }

}