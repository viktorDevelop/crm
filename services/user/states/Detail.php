<?php
namespace services\user\states;

use core\interfaces\StateInterface;

class Detail implements StateInterface
{
    public function execute()
    {
        return 'view Detail';
    }
}