<?php
namespace modules\posts;
use core\Request;

class PostsService
{
    private $request;

    public function __construct($request = null)
    {
        /** @var Request $request */
        $this->request = $request;
    }

    public function getData()
    {
        $posts = new Posts();
        $data = [];
        if ($id = $this->request->getParams('id'))
        {
            $posts->find($id);
            $data =  $posts->toArray();
        }else{
            $posts->findAll();
            $data =  $posts->toArray();
        }
        return  $data;
    }

    public function postsList($arParams = [])
    {
        $limit = $arParams['limit'] ?? 20;
        $offset = $arParams['offset'] ?? 0;

        $posts = new Posts();
        $posts->findAll($limit,$offset);
        $data = [];
        $data =  $posts->toArray();
        return $data;
    }
}