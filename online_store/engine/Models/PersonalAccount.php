<?php

namespace MyApp\Models;

class PersonalAccount extends Model
{
    const USERS_TABEL = 'users';

    public $user;

    // public static function getUser()
    // {
    //     return self::db()->getOneRow(self::USERS_TABEL, '');
    // }

    public static function login($user_name, $user_password)
    {
        if (empty($user_name) || empty($user_password)) {
            echo "ничего нет";
            return;
        }

        $user = self::db()->getOneRow(self::USERS_TABEL, 'user_name', $user_name);
        if (password_verify($user_password, $user['password_hash'])) {
            return $user;
        }
    }
    
}