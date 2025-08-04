<?php
namespace core;

class Request
{
    private array $params;

    public function __construct($params = [])
    {
        $this->params = $params;
    }

    public function get($name = '')
    {
        if ($name)
            return isset($_GET[$name]) ?? $_GET[$name];
        return $_GET;
    }



    public function data($name = '')
    {
        $post = file_get_contents('php://input');
        $arPost = ($post) ? json_decode($post,true) : [];
        if (!empty($_POST))
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


    /**
     * @param $k
     * @return array|string|null
     */
    public function getParams($k = ''): array | string | null
    {
        if (!empty($k))
            return $this->params[$k];
        return $this->params;
    }
}