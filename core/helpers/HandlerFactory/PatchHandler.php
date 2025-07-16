<?php
namespace core\helpers\HandlerFactory;

class PatchHandler extends MethodHandler {
    protected function getAction() {
        return 'actionUpdate';
    }
}