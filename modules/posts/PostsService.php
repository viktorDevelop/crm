<?php
namespace modules\posts;
use core\Request;
use modules\category\CategoryService;

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
        $section_code = $arParams['section_code'] ?? 0;

        $category = new CategoryService();
        $id = $category->getCategoryIDByCode($section_code);

        $posts = new Posts();
        $posts->findAllBy(['category_id'=>$id]);
        $data = [];
        $data =  $posts->toArray();

//        echo '<pre>';
//        print_r($data);
        return $data;
    }

//    public function Post
}