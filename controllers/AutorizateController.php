<?php
namespace controllers;

use components\autorizate\form\Autorizate;
use core\Helpers\AES;
use core\interfaces\Controller;
use core\Request;
use core\Responce;
use core\View;
use models\Users;

class AutorizateController extends BaseController implements Controller
{

    public function actionExecute(Request $request)
    {

         return $this->view->render('layouts/auth');
    }

    public function actionFind(Request $request)
    {
        return '';
    }

    public function action403(Request $request)
    {
        $authorize = new Autorizate();
        $rs = $authorize->authorize($request->data('login'),$request->data('password'));
        return Responce::send([
            "status"=>true,
            "auth"=> $rs
        ]);


    }

    public function actionStore(Request $request)
    {
       return false;
    }

}