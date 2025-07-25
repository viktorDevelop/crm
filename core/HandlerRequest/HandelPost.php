<?php

namespace core\HandlerRequest;

class HandelPost extends AHandle
{
    public function handle($request): ?string
    {
        if ($request == 'POST')
        {
            return 'actionStore';
        }
        return parent::handle($request);
    }
}