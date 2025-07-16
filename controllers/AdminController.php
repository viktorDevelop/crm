<?php
namespace controllers;

use core\interfaces\PageInterface;
use core\Request;
use core\Template;

class AdminController implements PageInterface
{
    public function __construct($params = [])
    {

    }

    public function actionList(Request $request)
    {
        $tmp = new Template('admin');
        $tmp->setTitle('admin category list');
        $tmp->setContent('category.list');
        $tmp->show();
    }

    public function actionExecute()
    {

        $tmp = new Template('admin');
        $tmp->setTitle('admin category list');
        $tmp->setContent('pages');
        $tmp->show();
    }
    public function actionMain(Request $request)
    {
        // TODO: Implement actionMain() method.
    }

    public function actionSectionList(Request $request)
    {
        // TODO: Implement actionSectionList() method.
    }
}