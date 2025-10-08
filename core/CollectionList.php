<?php
namespace core;

use services\Posts\PostsService;

class CollectionList
{
    public function execute(array $params = [])
    {
        $view = View::getInstance();
        return $view->render('blog/components/popular.posts',[
            'arData'=>PostsService::getPublicPost()
        ]);
    }
}