<?php
/**
 * класс для работы с постами
 */
namespace crm\controllers;

use crm\core\Request;
use crm\Post\PostRepository;
use crm\Post\PostService;


class PostController
{
    /**
     * выводит все посты
     * @param Request $request
     * @return array
     */
    public function actionIndex(Request $request)
    {
//        $postService = new PostService(new PostRepository());
//        $postService->setCategoryPost($request->get('section'));
//        $res = $postService->getPosts();
//        $res['req'] = $request->get();
        return $request->get();
    }


    /**
     * @param Request $request
     * @return array
     */
    public function actionPosts(Request $request)
    {
        $postService = new PostService(new PostRepository());
        $postService->setLimit(3);

        $postService->setPage(intval($_GET['page']));
        $res = $postService->getPosts();
        return $res;
    }
}