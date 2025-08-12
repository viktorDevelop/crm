<?php
namespace core;

class Database
{
    private static $instance;

    /**
     * @return mixed
     */
    public static function getInstance():Database
    {
        if (!isset(self::$instance))
        {
            $cl = __CLASS__;
            self::$instance = new $cl;
        }

        return self::$instance;
    }

    private function __construct(){
        $arConfig = [];
        $arConfig['host'] = 'db';
        $arConfig['user'] = 'bitrix';
        $arConfig['db_name'] = 'bitrix';
        $arConfig['password'] = '123';
        $this->pdo = new \PDO('mysql:dbname='.$arConfig['db_name'].';host='.$arConfig['host'],$arConfig['user'],$arConfig['password']);
    }

    public function getPdoObject():\PDO
    {
        return $this->pdo;
    }
}