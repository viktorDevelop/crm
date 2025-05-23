<?php
namespace controllers;

use core\interfaces\Request;
use core\interfaces\RestInterface;
use core\Responce;

class CategoryController implements RestInterface
{


    public function actionIndex(\core\Request|\core\interfaces\Request $request)
    {
         return Responce::send($request->get());
    }

    public function actionFind(\core\Request|\core\interfaces\Request $request)
    {
        // TODO: Implement actionFind() method.
    }

    public function actionSave(\core\Request|\core\interfaces\Request $request)
    {
        // TODO: Implement actionSave() method.
    }

    public function actionDelete(\core\Request|\core\interfaces\Request $request)
    {
        // TODO: Implement actionDelete() method.
    }
}