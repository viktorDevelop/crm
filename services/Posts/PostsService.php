<?php
namespace services\Posts;

use core\Request;

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

    public static function getPostsIndex()
    {
        $mPost = new Posts();
        $mPost->model->findAll();
        return $mPost->model->toArray();
    }

    public static function getPostsList($page = null)
    {

    }

    public static function getPost( Request $request)
    {
        $mPost = new Posts();
        $mPost->model->findBy(['code'=>$request->getParams('post_code')]);
        return $mPost->model->toArray();
    }
}