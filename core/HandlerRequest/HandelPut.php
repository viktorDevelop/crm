<?php

namespace core\HandlerRequest;

class HandelPut extends AHandle
{
    public function handle($request): ?string
    {
        if ($request == 'PUT')
        {
            return 'actionUpdate';
        }
        return parent::handle($request);
    }
}