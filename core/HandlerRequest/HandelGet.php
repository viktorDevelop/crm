<?php

namespace core\HandlerRequest;

use components\autorizate\form\Autorizate;

class HandelGet extends AHandle
{
    private string $type;

    public function __construct($type = '')
    {
        $this->type = $type;
    }

    public function handle($request): ?string
    {
        $auth = Autorizate::checkUserRole();

        if ($request == 'GET')
        {
            if ($this->type == 'rest')
            {
                if (!$auth)
                    return 'action403';
                return 'actionFind';

            }else{
                return 'actionExecute';
            }

        }else{
            return parent::handle($request);
        }
    }
}