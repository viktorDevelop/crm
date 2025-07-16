<?php
namespace core\helpers\HandlerFactory;

class PutHandler extends MethodHandler {
    protected function getAction() {
        return 'actionUpdate';
    }
}