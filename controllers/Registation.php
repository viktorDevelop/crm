<?php

namespace controllers;

use core\Helpers\AES;
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
        $passwrod = $request->data('password');
        $passwrod = md5(sha1($passwrod));
        $token_data = [
           "login"=> $request->data('login'),
            "role"=>$request->data('role'),
            'data_created'=>(new \DateTime('now'))->format('Y-m-d h:i'),
            'date_expired'=>(new \DateTime('now'))->modify('+2 hour')->format('Y-m-d h:i')
        ];

        $token_data = json_encode($token_data);
        $token = AES::encrypt($token_data,$passwrod);
        $user = new Users(
            $request->data('login'),
            $request->data('name'),
            $passwrod,
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