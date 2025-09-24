<?php
namespace services\users;


use core\SimpleOrm;

/**
 * Модель данных
 * @property SimpleOrm $model
 */
class Users
{
    public ?int $id = null;
    public string $login;
    public string $password;
    public string $role;
    public string $name;
    public string $phone;

    public function __construct()
    {
        $this->model = new SimpleOrm(self::class);
    }

    public function getLogin()
    {
        $this->model->find(1);

    }



}