<?php
namespace services\categoryViewer\states;

use core\interfaces\StateInterface;

class Detail implements StateInterface
{
    public function execute()
    {
        return 'view Detail';
    }
}