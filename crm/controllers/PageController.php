<?php
namespace crm\controllers;

use crm\core\Request;
use crm\core\View;

class PageController extends FrontController
{
    protected static $templateName = 'blog';
    public function actionIndex()
    {
//        $tmp = new \crm\core\Template('blog');
//
//        $tmp->setTitle('category title');
//
//
        $gal = new \crm\core\Template('blog');
        $gallery = $gal->render('category.gallery',['arResult'=>['gall']]);
//
//        $tmp->setContent('category.list',['arResult'=>'data category list','gallery'=>$gallery]);
//
//        $tmp->show();
        $this->template->setTitle('test title category list');
        $this->template->setContent('category.list');
        $this->template->show();


    }



}