<?php
namespace core\interfaces;

interface IRest
{
    public function actionIndex(\core\Request $request);
    public function actionStore(\core\Request $request);
    public function actionUpdate(\core\Request $request);
    public function actionDelete(\core\Request $request);
}