<?php
namespace core\interfaces;

use core\Request;

interface AjaxResource
{
    public function handleAjax(Request $request);
}