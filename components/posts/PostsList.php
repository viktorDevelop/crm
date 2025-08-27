<?php
namespace components\posts;

class PostsList
{
    public function render()
    {
        $view = \core\View::getInstance();
        return $view->render('blog/posts/list');
    }
}