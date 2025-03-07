<?php
namespace crm\core;

class Request
{
    private $params;
    public function set($params = [])
    {
        $this->params = $params;
    }

    public function get($key = '')
    {
        if ($this->params){
            if (key_exists($key,$this->params))
                return $this->params[$key];
        }
        return  $this->params;
    }

    public function post($key='')
    {
       $post = file_get_contents('php://input');
       $arPost = json_decode($post,true);
        if ($arPost && $key && key_exists($key,$arPost))
            return $arPost[$key];
        else
         return $arPost;
    }
}