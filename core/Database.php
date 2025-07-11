<?php
namespace core;


class Database
{
    public static $instance;

    public static function getInstance()
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

    /**
     * @return \PDO
     */
    public function getConnect(): \PDO
    {
        return $this->pdo;
    }
}