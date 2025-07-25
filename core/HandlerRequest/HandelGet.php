<?php

namespace core\HandlerRequest;

class HandelGet extends AHandle
{
    private string $type;

    public function __construct($type = '')
    {
        $this->type = $type;
    }

    public function handle($request): ?string
    {
        if ($request == 'GET')
        {   if ($this->type == 'rest')
        {
            return 'actionFind';

        }else{
            return 'actionExecute';
        }

        }else{
            return parent::handle($request);
        }
    }
}