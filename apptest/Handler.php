<?php

namespace apptest;

interface Handler
{
    public function setNext(Handler $handle):Handler;
    public function handle(string $request):?string;
}