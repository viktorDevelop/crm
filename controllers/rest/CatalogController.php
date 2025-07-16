<?php
namespace controllers\rest;


use core\interfaces\IRest;

class CatalogController implements IRest
{

    public function actionIndex(\core\Request $request)
    {
        echo 'actionIndex';
    }

    public function actionStore(\core\Request $request)
    {
        echo 'actionStore';
    }

    public function actionUpdate(\core\Request $request)
    {
        return 'actionUpdate';
    }

    public function actionDelete(\core\Request $request)
    {
        return 'actionDelete';
    }
}

