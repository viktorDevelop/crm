<?php
namespace crm\Users;

use crm\core\Model;

class UserEntity extends Model
{
    protected static $table = 'users';


    protected static $field = [
        'id'=>'integer',
        'login'=>'string',
        'name'=>'string',
        'password'=>'string'


    ];

    protected static $required = [
        'id','password'

    ];

    public function isAdmin()
    {

    }
}