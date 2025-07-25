<?php

namespace core\HandlerRequest;

use core\interfaces\Handle;

class AHandle
{
    private  $nexHandle = null;

    public function setNext($handle)
    {

        $this->nexHandle = $handle;
        return  $handle;
    }

    public function handle($request):?string
    {
        if ($this->nexHandle)
        {
            return $this->nexHandle->handle($request);
        }
        return null;
    }
}