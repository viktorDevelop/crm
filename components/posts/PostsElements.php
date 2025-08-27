<?php
namespace components\posts;

class PostsElements
{
    public function render()
    {
        $view = \core\View::getInstance();
        return $view->render('blog/posts/detail',['postsElementData'=>[
            'post'=>[],
            'comments'=>[]
        ]]);
    }
}