<?php
namespace controllers;

use core\Helpers\AES;
use core\interfaces\Controller;
use core\Request;
use core\Responce;
use models\Users;

class AutorizateController extends BaseController implements Controller
{

    public function actionExecute(Request $request)
    {
         return $this->view->render('layouts/auth');
    }

    public function actionFind(Request $request)
    {
        // TODO: Implement actionFind() method.
    }

    public function actionStore(Request $request)
    {
        $login = $request->data('login');
        $password = $request->data('password');
        $password = md5(sha1($password));

        $user = new Users();
        $user->findBy(['login'=>$login,'password'=>$password]);
        $res = $user->toArray();

        if ($res > 0)
        {
            $_SESSION['token'] = $res[0]['token'];
        }

        $tok_test = AES::decrypt($_SESSION['token'],$password);
//        unset($_SESSION['token']);
        return Responce::send([
            'status'=>true,
            'data'=>$res,
            '$tok_test'=>$tok_test
        ]);
    }



    public static function UserIsAuth()
    {
         return $_SESSION['token'];
    }


}