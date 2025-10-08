<?php
namespace services\Posts;

class PostsService
{
    public static function getPublicPost():array
    {
        $mPost = new  Posts();
        $mPost->model->findAllBy(['pupular='=>true]);
        return $mPost->model->toArray();
    }
}