<?php

namespace apptest;

class AHandle implements Handler
{
    private ?Handler $nextHandler = null;

    public function setNext(Handler $handle): Handler
    {
         $this->nextHandler = $handle;
         return $handle;
    }

    public function handle(string $request): ?string
    {
        if ($this->nextHandler)
        {
            return $this->nextHandler->handle($request);
        }
        return null;
    }
}