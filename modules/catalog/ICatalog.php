<?php
namespace modules\catalog;

use core\Request;

interface ICatalog
{
    public function showList():void;
    public function showDetail():void;
}