<?php
namespace modules\posts\components;

use modules\posts\PostsService;

class PostList
{
    public static function getData($arParams = [])
    {
        $sPosts = new PostsService();
        $arPosts = $sPosts->postsList($arParams);
        return   ['PostListData'=>$arPosts ];
    }
}