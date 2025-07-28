<?php
namespace core\interfaces;

use core\Request;

interface Controller
{
    public function actionExecute(Request $request);
    public function actionFind(Request $request);
    public function actionStore(Request $request);
}