<?php
namespace crm\controllers;

use crm\core\Request;
use crm\Post\PostRepository;
use crm\Post\PostService;

class PostController
{
    public function actionIndex(Request $request)
    {
        $postService = new PostService(new PostRepository());
        $postService->setCategoryPost($request->get('section'));
        $res = $postService->getPosts();
        return $res;
    }

    //category/bitrix/php-article
    public function actionPosts(Request $request)
    {
        $postService = new PostService(new PostRepository());
        $postService->setLimit(3);

        $postService->setPage(intval($_GET['page']));
        $res = $postService->getPosts();
        return $res;
    }
}