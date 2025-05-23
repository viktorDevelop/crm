<?php
namespace core\interfaces;

use core\Request;

interface RestInterface
{
    public function actionIndex(Request|\core\interfaces\Request $request);
    public function actionFind(Request|\core\interfaces\Request $request);
    public function actionSave(Request|\core\interfaces\Request $request);
    public function actionDelete(Request|\core\interfaces\Request $request);
}
