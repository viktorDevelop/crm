<?php
namespace controllers;

use core\Request;
use core\interfaces\RestInterface;
use core\Responce;

class UsersController implements RestInterface
{

    public function actionIndex(Request|\core\interfaces\Request $request)
    {
        return Responce::send($request->get());
    }

    public function actionFind(Request|\core\interfaces\Request $request)
    {
        return Responce::send($request->data());
    }

    public function actionSave(Request|\core\interfaces\Request $request)
    {
        return Responce::send($request->data());
    }

    public function actionDelete(Request|\core\interfaces\Request $request)
    {
        return Responce::send($request->data());
    }
}
