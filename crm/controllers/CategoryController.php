<?php
namespace crm\controllers;


use crm\core\Request;

class CategoryController
{
    public function actionIndex(Request $request)
    {

       return ['title'=>312];

    }

    //category/bitrix/php-article
    public function actionPosts(Request $request)
    {
        echo $request->get();
        echo 'fasdfsf';
    }

}