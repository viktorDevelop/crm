<?php
namespace controllers;

use core\interfaces\PageInterface;
use core\Request;
use core\Template;

class HomeController implements PageInterface
{

    public function actionMain(Request $request)
    {
//        var_dump($request->get('sort'));
        $tmp = new Template('blog');
        $tmp->setTitle('ttt');
        $tmp->setContent('category.list');
        $tmp->show();
    }

    public function actionSectionList(Request $request)
    {
        $tmp = new Template('blog');
        $tmp->setTitle('ttt');
        $tmp->setContent('category.list',["$arResult"=>$request->get()]);
        $tmp->show();
    }
}