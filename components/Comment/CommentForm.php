<?php
namespace components\Comment;

use core\View;

class CommentForm
{
    public function render()
    {
        /** @var $view View */
        $view = View::getInstance();
        return $view->render('components/coments/commentForm');
    }
}