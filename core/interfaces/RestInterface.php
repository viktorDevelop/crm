<?php
namespace core\interfaces;

use core\Request;

interface RestInterface
{
    public function actionIndex(Request $request);
    public function actionFind(Request $request);
    public function actionSave(Request $request);
    public function actionDelete(Request $request);
}
