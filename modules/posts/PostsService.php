<?php
namespace modules\posts;
use core\Request;

class PostsService
{
    private $request;

    public function __construct($request)
    {
        /** @var Request $request */
        $this->request = $request;
    }

    public function getData()
    {
        return  $this->request->getParams('id');
    }
}