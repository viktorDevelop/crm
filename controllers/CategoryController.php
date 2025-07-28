<?php

namespace controllers;

use components\Comment\CommentList;
use core\interfaces\Controller;
use core\Request;
use core\Responce;

class CategoryController extends BaseController implements Controller
{

    public function actionExecute(Request $request)
    {


        return  $this->view->render('layouts/main',[
            'title'=>'home'

        ]);


    }

    public function actionFind(Request $request)
    {
       return Responce::send([
           'success'=>true,
            '$request'=>$request->data()
       ]);
    }

    public function actionStore(Request $request)
    {
        return Responce::send([
            'success'=>true,
            'request'=>$request->data()
        ]);

    }

    public function actionUpdate()
    {
        echo 'rest actionUpdate';
    }
}