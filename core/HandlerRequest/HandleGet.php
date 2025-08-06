<?php
namespace core\HandlerRequest;

use controllers\RestController;
use core\Request;

class HandleGet extends MethodHandle
{

    function getHandler()
    {
//
//        if (!$this->type)
//        {
//            return  $this->object->execute((new Request()));
//        }
//
        if ($this->type)
            echo  (new RestController())->find($this->request);
    }
}