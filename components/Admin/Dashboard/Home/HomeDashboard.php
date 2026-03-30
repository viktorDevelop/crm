<?php

namespace components\Admin\Dashboard\Home;


use core\DashbordBaseController;
use core\Template;

class HomeDashboard extends DashbordBaseController
{
    public function show()
    {
        echo $this->element_code;
        $template = new Template('admin');
        $template->show();

    }
}