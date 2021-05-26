<?php

namespace MyApp\Models;

class PersonalAccount extends Model
{
    const TABEL = 'users';
    const ADMIN_ROLE = 1;

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

    public static function checkUserRole($user_id)
    {
        $user = self::link()->query('SELECT role_id FROM ' . self::TABEL . ' WHERE id = ' . $user_id . ' LIMIT 1')->fetch(\PDO::FETCH_ASSOC);
        if ($user['role_id'] == self::ADMIN_ROLE) {
            return true;
        } else {
            return false;
        }
    }
    
    // public static function checkUser($user_id)
    // {
	// 		if($access_result){
	// 			$row = mysqli_fetch_assoc($access_result);
	// 			if($row['role_id'] != 1){
	// 				header("Location: ./index.php");
	// 			}
	// 		}
    // }
}