<?php
namespace services\categoryViewer\states;

use core\interfaces\StateInterface;

class ListItems implements StateInterface
{
    public function execute()
    {
        return 'view ListItems';
    }
}