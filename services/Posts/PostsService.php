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

    public static function getRatingPosts():array
    {
        $mPost = new Posts();
        $mPost->model->findAllBy(['likes >= '=>5]);
        return $mPost->model->toArray();
    }
}