<?php
namespace core\helpers\HandlerFactory;

class PostHandler extends MethodHandler
{

    protected function getAction()
    {
        return 'actionStore';
    }
}