<?php
namespace core\HandlerRequest;

use controllers\NotFoundController;
use core\Request;

abstract class MethodHandle
{
    protected $type;
    protected $object;

    public function __construct($object,Request $request,$arComponents = [],$isRest = false)
    {
        $this->request = $request;
        $this->type = $isRest;
        if (!class_exists($object)){
            $this->object =  new NotFoundController((new Request()));
        }else{
            $obj = new  $object($arComponents);
            $this->object = $obj;
        }

    }

    abstract function getHandler();
}

