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
        $section_id = $category->getCategoryIDByCode($section_code);
        $posts = new Posts();
        $posts->findAllBy(['category_id'=>$section_id]);
        $data = [];
        $data =  $posts->toArray();

        return $data;
    }

    public function postItemByCode($arParams = [])
    {
        $data = [];
        $section_code = $arParams['section_code'] ?? 0;
        $postAlias = $arParams['element_code'] ?? 0;

        $category = new CategoryService();
        $section_id = $category->getCategoryIDByCode($section_code);

        $posts = new Posts();
        $posts->findAllBy(['category_id'=>$section_id,'alias'=>$postAlias]);
        $data = $posts->toArray();

        return $data;
    }

//    public function Post
}