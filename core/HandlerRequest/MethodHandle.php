<?php
namespace core\HandlerRequest;

use controllers\NotFoundController;
use core\PageConfigHelper;
use core\Request;

abstract class MethodHandle
{
    protected $type;
    protected PageConfigHelper $configPage;
    public function __construct( PageConfigHelper $configPage)
    {
        $this->configPage = $configPage;
        $this->type = $configPage->isRest;
        $this->request = $configPage->request;
    }

    abstract function getHandler();
}

