<?php
namespace components\Admin\Dashbord\Pages;

use components\Admin\Dashbord\DashbordComponent;

class PagesDashbord extends DashbordComponent
{
    public function actionShow()
    {
        $this->template->setProperty('title','Новая страница');
        $this->template->setContentView('forms/page/add');
        $this->template->show();

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