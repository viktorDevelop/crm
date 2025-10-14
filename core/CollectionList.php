<?php
namespace core;

use services\Posts\PostsService;

class CollectionList
{
    public function execute($params)
    {

        $params = json_decode($params);

//        var_dump($params);
        $view = View::getInstance();
        if (!$params->template)
            return  false;

        if (!$params->model)
            return false;

        if (!$params->action)
            return false;

        $obj = new $params->model();

        return $view->render($params->template,[
            'title'=>$params->title,
            'arData'=> $obj::{$params->action}()
        ]);

    }
}