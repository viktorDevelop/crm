<?php
namespace services\user\states;

use core\interfaces\StateInterface;

class ListItems implements StateInterface
{
    public function execute()
    {
        return 'view ListItems users';
    }
}