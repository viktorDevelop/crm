<?php
namespace modules\posts\components;

use core\Request;
use modules\posts\PostsService;

class PostList
{
    public static function getData($arParams = [],Request $request)
    {

        $sPosts = new PostsService();
        $arParams['section_code'] = $request->getParams('category_code');
        $arPosts = $sPosts->postsList($arParams);
        return   ['PostListData'=>$arPosts ];
    }
}