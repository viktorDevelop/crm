<?php
namespace core\HandlerRequest;

use controllers\NotFoundController;
use core\PageConfigHelper;
use core\Request;

abstract class MethodHandle
{
    protected $type;
    protected $object;

    public function __construct( PageConfigHelper $configPage)
    {

        $this->type = $configPage->isRest;

        $this->request = $configPage->Request;
//        echo "<pre>";
//        var_dump();

    }

    abstract function getHandler();
}

