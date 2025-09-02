<?php
namespace components\users;

use core\Request;
use core\Responce;

class UsersRestService
{
    public function actionFind(Request $request)
    {
        $user = new Users();

        if ($id = $request->getParams('id'))
        {
            $user->model->find($id);
            $res = $user->model->toArray();
        }else{
            $user->model->findAll();
            $res = $user->model->toArray();
        }

        return Responce::send([
            'status'=>true,
            'data'=>$res
        ]);
    }

    public function actionSave(Request $request)
    {
        return Responce::send([
            'status'=>true,
            'data'=>$request->data()
        ]);
    }

    public function actionDelete(Request $request)
    {

    }

    public function actionAutorizate(Request $request)
    {
        return Responce::send();
    }


}