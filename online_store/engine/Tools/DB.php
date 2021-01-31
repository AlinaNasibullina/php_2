<?php

//namespace myApp\engine\Tools\DB; 
namespace myApp\engine\Tools; 

use myApp\engine\Tools\Singleton;
use Throwable;
use PDO;

final class DB
{
    use Singleton;

    const PRODUCT_TABEL = 'product';
    
    private static $settings=[
        'dsn' => 'mysql:host=localhost;dbname=shop_brand',
        'user' => 'root',
        'password' => 'root',
    ];
    private $link;

    public function getAllRow($tabelName) 
    {
        try {
            return $this->link
            ->query('SELECT * FROM ' . $tabelName)
            ->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            return false;
        }
    }

    public function getOneRow($tabelName, $id) 
    {
        try {
            return $this->link
                ->query('SELECT * FROM ' . $tabelName . ' WHERE id = ' . $id )
                ->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            return false;
        }
    }

    public function getAllActive($tabelName, $first_row = 0, $last_row = 2) {
        try {
            return $this->link
                ->query('SELECT * FROM ' . $tabelName . ' WHERE active = 1 LIMIT ' . $first_row . ', ' . $last_row)
                ->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            return false;
        }
    }

    private function __construct()
    {
        $this->link = new PDO(
            self::$settings['dsn'],
            self::$settings['user'],
            self::$settings['password']
        );
        if (false === $this->link) {
            die("Can't connect to database");
        }        
    }
}
