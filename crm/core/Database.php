<?php
namespace crm\core;

class Database
{
    private $pdo;
    private $sth;
    private static $instance;
    private  function __construct()
    {
        $arConfig = [];
        $arConfig['host'] = 'db';
        $arConfig['user'] = 'bitrix';
        $arConfig['db_name'] = 'bitrix';
        $arConfig['password'] = '123';
        $this->pdo = new \PDO('mysql:dbname='.$arConfig['db_name'].';host='.$arConfig['host'],$arConfig['user'],$arConfig['password']);

    }

    /**
     * @return Database
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {

            $cl = __CLASS__;

            self::$instance = new $cl;
        }

        return self::$instance;
    }

    /**
     * @param $sql
     * @return Database
     */
    public function query($sql)
    {
        $this->sth =  $this->pdo->prepare($sql);
        return $this;
    }

    /**
     * @param $column
     * @param $val
     * @return Database
     */
    public function setValue($column, $val,$param = 2 )
    {
        $this->sth->bindValue(':'.$column,$val,$param);
        return $this;
    }

    /**
     * @return Database
     */
    public function execute()
    {
        $this->sth->execute();
        return $this;
    }

    /**
     * @param $type
     * @return Database
     */
    public function getAll($type = '')
    {
        if ($type){
            return $this->sth->fetchAll($type);
        }else{
            return $this->sth->fetchAll();
        }
    }

    /**
     * @param $type
     * @return Database
     */
    public function getOne($type = '')
    {
        if ($type){
            return $this->sth->fetch($type);
        }else{
            return $this->sth->fetch();
        }

    }

}