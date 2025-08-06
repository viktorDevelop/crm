<?php

namespace controllers;

use core\Request;

class NotFoundController
{
    public function execute(Request $request)
    {
        http_response_code(404);
        echo 404;
    }
}