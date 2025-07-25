<?php

namespace core\interfaces;

interface Handle
{
    public function setNext(Handle $handle):Handle;
    public function handle($request):?string;
}