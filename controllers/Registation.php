<?php

namespace controllers;

use core\interfaces\Controller;
use core\Request;
use core\Responce;
use models\Users;

class Registation extends BaseController implements Controller
{

    public function actionExecute(Request $request)
    {
        return $this->view->render('/layouts/reg');
    }

    public function actionFind(Request $request)
    {

    }

    public function actionStore(Request $request)
    {
        $token = 'sd';
        $user = new Users(
            $request->data('login'),
            $request->data('name'),
            $request->data('password'),
            $request->data('role'),
            $token

        );

        $user->save($user);
        if ($user->getError())
        {
            return Responce::send([
                'status'=>false,
                'message'=>'пользователь уже существует'
            ]);
        }
        return Responce::send([
            'status'=>true,
            'data'=>$user,
        ]);
    }
}