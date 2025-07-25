<?php

namespace controllers;

use components\Comment\CommentList;
use core\interfaces\Controller;
use core\Request;

class CategoryController extends BaseController implements Controller
{

    public function actionExecute(Request $request)
    {


        return  $this->view->render('layouts/main',[
            'title'=>'home'

        ]);


    }

    public function actionFind()
    {
        echo 'rest actionFind';
    }

    public function actionStore()
    {
        echo 'rest actionStore';
    }

    public function actionUpdate()
    {
        echo 'rest actionUpdate';
    }
}