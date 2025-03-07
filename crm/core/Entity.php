<?php
namespace crm\core;

class Entity
{
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



}
