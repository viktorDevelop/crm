<?php
namespace crm\Irepository;
interface IServise
{
    public function find(string $field,$val):array;
    public function findAll(string $field,$val):array;
    public function delete(int $id):void;
    public function save():void;
}