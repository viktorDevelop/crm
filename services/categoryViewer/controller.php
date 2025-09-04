<?php
namespace services\categoryViewer;

use core\BaseController;

class controller extends BaseController
{
    public function actionShowPage()
    {
        return $this->state->execute();

    }
}