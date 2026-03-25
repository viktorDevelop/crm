<?php

namespace components\Admin\Dashbord\Home;

use components\Admin\Dashbord\DashbordComponent;

class HomeDashbord extends DashbordComponent
{
    public function actionIndex()
    {
        $this->template->setProperty('title','Новая страница');
        $this->template->setContentView('forms/page/add');
        $this->template->show();
    }
}