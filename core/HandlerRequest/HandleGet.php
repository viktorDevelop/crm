<?php
namespace core\HandlerRequest;

use controllers\PageController;
use controllers\RestController;
use core\Request;

class HandleGet extends MethodHandle
{

    function getHandler()
    {
        if (!$this->type)
            echo  (new PageController($this->configPage))->execute();

        if ($this->type)
            echo  (new RestController())->find($this->request);
    }
}