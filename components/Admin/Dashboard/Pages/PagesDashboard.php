<?php
namespace components\Admin\Dashboard\Pages;

use core\DashbordBaseController;
use core\Request;

class PagesDashboard extends DashbordBaseController
{
    public function actionShow( )
    {

        //        $this->template->setProperty('title','Новая страница');
//        $this->template->setContentView('forms/page/add');
//        $this->template->show();
        send2Log([
            $this->request->getParams()
        ]);
        echo 'actionShow';
    }

    public function actionEdite()
    {
        echo 'actionEdite';
    }

    public function actionDelete()
    {
        echo 'actionDelete';
    }

    public function actionCreate()
    {
        echo 'actionCreate';
    }

}