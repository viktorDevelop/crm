<?php
namespace models;

use core\SimpleORM;

class Users extends SimpleORM
{
    public ?int $id = null;
    public string $login;
    public string $name;
    public string $password;
    public string $role;
    public string $token;

    public function __construct(
      $login,
       $name,
       $password,
       $role,
        $token
    )
    {

        $this->login = $login;
        $this->name = $name;
        $this->password = $password;
        $this->role = $role;
        $this->token = $token;
        parent::__construct(__CLASS__);
    }


}