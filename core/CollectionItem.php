<?php
namespace core;

class CollectionItem
{
    public function execute($params,$request)
    {
        $params = json_decode($params);

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
            'arData'=> $obj::{$params->action}($request),
            'setting_template'=>$params
        ]);
    }

}