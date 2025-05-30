<?php
namespace core;

class Request
{
    public function get($name = '')
    {
        if ($name)
            return $_GET[$name];
        return $_GET;
    }

    public function data($name = '')
    {
        $post = file_get_contents('php://input');
        $arPost = ($post) ? json_decode($post,true) : [];
        if (isset($_POST))
            $arPost = array_merge($_POST, $arPost);

        if ($arPost && $name && key_exists($name,$arPost))
            return $arPost[$name];
        else
            return $arPost;
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}