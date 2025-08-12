<?php
namespace core;

class Database
{
    private static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $cl = __CLASS__;
            self::$instance = new $cl;
        }

        return self::$instance;
    }

    private function __construct()
    {
        $dbCon = 	include $_SERVER['DOCUMENT_ROOT'].'/config/Database.php';
        try{
            $this->db  = new \PDO('mysql:dbname='.$dbCon['db_name'].';host='.$dbCon['host'],$dbCon['user'],$dbCon['password']);
        }catch (\PDOException $e){
            echo $e->getMessage();
        }

    }
}