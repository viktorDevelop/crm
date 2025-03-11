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
        $sth = $this->db->query('SELECT * FROM '.self::$table.'WHERE login = :login AND password = :password' );
        $sth->setValue('login','viktor');
        $sth->setValue('password','123');
        return $sth->getOne(\PDO::FETCH_ASSOC);


    }
}