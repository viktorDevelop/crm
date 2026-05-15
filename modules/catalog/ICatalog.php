<?php
namespace modules\catalog;

use core\Request;

interface ICatalog
{
    public function showList(Request $request,string $model,string $templateName):void;
    public function showDetail(Request $request,string $model,string $templateName):void;
}