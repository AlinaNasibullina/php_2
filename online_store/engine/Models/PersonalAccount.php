<?php

namespace MyApp\Models;

use Throwable;

class PersonalAccount extends Model
{
    const TABEL = 'users';

    public $user;

    public static function getUser($user_name)
    {
        if (empty($user_name)) {
            return "пусто";
        }
        
        $stmt = self::link()->prepare('SELECT * FROM ' . self::TABEL . " WHERE user_name = :user_name LIMIT 1");
        $stmt->bindParam(':user_name', $user_name, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function checkUser($user_name, $user_password)
    {
        if (empty($user_name) || empty($user_password)) {
            return false;
        }

        $user = self::getUser($user_name);
        return password_verify($user_password, $user['password_hash']);
    }
    
}