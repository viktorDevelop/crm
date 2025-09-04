<?php
namespace  services\categoryViewer\states;

use core\BaseState;
use core\interfaces\StateInterface;
use core\View;

class SectionList extends BaseState implements StateInterface
{

    protected function getDate()
    {
        return ['title'=>"sdf"];
    }
}