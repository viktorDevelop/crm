<?php
namespace  services\user\states;

use core\interfaces\StateInterface;

class SectionList implements StateInterface
{
    public function execute()
    {
        return 'view SectionList';
    }
}