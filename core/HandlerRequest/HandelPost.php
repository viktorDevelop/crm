<?php

namespace core\HandlerRequest;

use components\autorizate\form\Autorizate;

class HandelPost extends AHandle
{
    public function handle($request): ?string
    {
        $auth = Autorizate::checkUserRole();

        if (!$auth)
            return 'action403';
        if ($request == 'POST')
        {
            return 'actionStore';
        }
        return parent::handle($request);
    }
}