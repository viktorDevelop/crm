<?php
namespace controllers;

use core\interfaces\PageInterface;
use core\Request;
use core\Template;

class HomeController implements PageInterface
{
    public function __construct($params = [])
    {

    }

    public function actionMain(Request $request)
    {
        $tmp = new Template('blog');
        $tmp->setTitle('ttt');
        $tmp->setContent('category.list');
        $tmp->show();
    }

    public function actionSectionList(Request $request)
    {
        $tmp = new Template('blog');
        $tmp->setTitle('ttt');
        $tmp->setContent('category.list');
        $tmp->show();
    }

    public function actionPostDetail(Request $request)
    {
        $tmp = new Template('blog');
        $tmp->setTitle('php');
        $tmp->setContent('posts.list');
        $tmp->show();
    }
}