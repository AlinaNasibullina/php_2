<?php

//namespace myApp\engine\Tools\DB; 
namespace myApp\Tools; 

use myApp\Tools\Singleton;
use Throwable;
use PDO;

final class DB
{
    use Singleton;
    
    private $link;
    public function getLink(): \PDO
    {
        return $this->link;
    }

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

    public function getOneRow($tabelName, $column_name, $column_value) 
    {
        try {
            return $this->link
                ->query('SELECT * FROM ' . $tabelName . ' WHERE '. $column_name . ' = "' . $column_value . '"')
                ->fetch(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            // return $e->getMessage();
            return false;
        }
    }

    // public function getAllActive($tabelName, $first_row = 0, $last_row = 2) {
    //     try {
    //         return $this->link
    //             ->query('SELECT * FROM ' . $tabelName . ' WHERE active = 1 LIMIT ' . $first_row . ', ' . $last_row)
    //             ->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (Throwable $e) {
    //         return false;
    //     }
    // }

    public function getAllActive ($tabelName) {
        try {
            return $this->link
            ->query('SELECT * FROM ' . $tabelName . ' WHERE active = 1')
            ->fetchAll(\PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            return false;
        }
    }

    public function getOneActive ($tabelName, $id) {
        try {
            return $this->link
            ->query('SELECT * FROM ' . $tabelName . ' WHERE active = 1 AND id = ' . $id)
            ->fetch(\PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            return false;
        }
    }

    public function addRow($tabelName, $column_name, $column_value)
    {
        return $this->link
        ->query('INSERT INTO ' . $tabelName . ' (' . $column_name . ') VALUES (' . $column_value . ')');
    }

    public function __construct($config)
    {
        try {
            $this->link = new \PDO(
                $config['dsn'],
                $config['user'],
                $config['password']
            );
        } catch (Throwable $e) {
            die($e->getMessage());
        }     
    }
}
