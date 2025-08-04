<?php
namespace core\HandlerRequest;

abstract class MethodHandle
{
    protected $type;
    protected $object;

    public function __construct($object,$isRest = false)
    {
        $this->type = $isRest;
        if (!class_exists($object))
            return null;

        $obj = new  $object();
        $this->object = $obj;
    }

    abstract function getHandler();
}

