<?php
namespace core\HandlerRequest;

class HandleGet extends MethodHandle
{

    function getHandler()
    {
        if (!$this->type)
            return  $this->object->execute();

        if ($this->type)
            return $this->object->find();
    }
}