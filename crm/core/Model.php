<?php

namespace crm\core;
use crm\core\Database;

class Model
{
    protected static $table;
    protected $db;
    protected $fields = [];
    public function __construct()
    {
        $this->db = Database::getInstance();

    }

    protected static $field = [];
    protected static $required = [];
    protected static $arError = [];
    private $data = [];


    private function __set(string $name, $value): void
    {
        $this->data[$name] = $value;
    }

    private function __get(string $name)
    {
        foreach (static::$field as $f=>$t)
        {
            $arF[] = $f;
        }
        if (in_array($name,$arF)){

            $this->validateType($name);

            return  $this->data[$name];
        }
        return false;
    }

    private function validateType($field)
    {
        $val = $this->data[$field];
        $type =  static::$field[$field];
        if (gettype($val) != $type){
            self::$arError[$field] = 'not '.$type;
            return false;
        }

    }

    /**
     * @return array
     */
    public static function getError(): array
    {
        return self::$arError;
    }

    public function getByAlias($alias = '')
    {
        $res =  $this->db->query('SELECT * FROM '.static::$table.' WHERE alias = :alias')
            ->setValue('alias',$alias)->execute()->getOne(\PDO::FETCH_ASSOC);


        foreach ($res as $k=>$val)
        {
            $this->$k = $val;
        }
        return $res;

    }

    public function getByField($field,$val,$all = false)
    {
        if ($all)
        {
            $res =  $this->db->query("SELECT * FROM ".static::$table." WHERE ".$field." = :".$field)
                ->setValue($field,$val)->execute()->getAll(\PDO::FETCH_ASSOC);
        }else{

            $res =  $this->db->query("SELECT * FROM ".static::$table." WHERE ".$field." = :".$field)
                ->setValue($field,$val)->execute()->getOne(\PDO::FETCH_ASSOC);
        }

        foreach ($res as $k=>$val)
        {
            $this->$k = $val;
        }
        return $res;

    }

    public function getByList()
    {
        $res =  $this->db->query('SELECT * FROM '.static::$table)
            ->execute()->getAll(\PDO::FETCH_ASSOC);
        return $res;
    }
}