<?php
namespace modules\posts\components;

use core\Request;
use modules\posts\PostsService;

class PostItem
{
    public static function getData($arParams = [],Request $request)
    {

        $post = new PostsService();
        $arPost = $post->postItemByCode($request->getParams());
        return   ['PostItemData'=>$arPost ];
    }
}
