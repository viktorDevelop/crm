<?php
namespace crm\controllers;

use crm\core\Request;

interface RestInterface
{
    public function actionIndex();
    public function actionGetByCode(Request $request);
    public function actionGetById(Request $request);
    public function actionSave(Request $request);
    public function actionDelete(Request $request);
}