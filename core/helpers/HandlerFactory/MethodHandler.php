<?php
namespace core\helpers\HandlerFactory;

abstract class MethodHandler
{
    private $oName;

    public function __construct($oName)
    {
        $this->oName = $oName;
    }
    public function handle()
    {
        if (!class_exists($this->oName))
        {
            return 404;
        }

        $obj = new $this->oName();
        $request = new \core\Request();
        return $obj->{$this->getAction()}($request);
    }

    abstract protected function getAction();
}

