<?php
namespace core\HandlerRequest;

use core\Request;

class HandleGet extends MethodHandle
{

    function getHandler()
    {

        if (!$this->type)
        {
            return  $this->object->execute((new Request()));
        }

        if ($this->type)
            return $this->object->find();
    }
}