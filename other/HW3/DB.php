<?php

final class DB
{
    const GALERY_TABEL = "galery";
    private static $settings=[
        'dsn' => 'mysql:host=localhost;dbname=php_course',
        'user' => 'root',
        'password' => 'root',
    ];

    private static $instance;
    private $link;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getAllRow($tabelName) 
    {
        return $this->link
            ->query('SELECT * FROM ' . $tabelName)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneRow($tabelName, $id) 
    {
        return $this->link
            ->query('SELECT * FROM ' . $tabelName . ' WHERE id = ' . $id )
            ->fetchAll(PDO::FETCH_ASSOC);
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