<?php
namespace core;

use components\Admin\Dashbord\DashbordComponent;
use components\Category\CategoryComponent;
use components\Category\CategoryListComponent;

class Application
{

    public static function run()
    {
        $routes = include $_SERVER['DOCUMENT_ROOT']."/bitrix/routes.php";

        $uri = $_SERVER['REQUEST_URI'];

        foreach ($routes as $k => $item)
        {
            if (preg_match($item["condition"],$uri))
            {
                $rule = preg_replace($item['condition'],$item['rule'],$uri);
                $current_rule = $item;
            }
        }
        parse_str($rule,$params);
        foreach ($params as $k=>$item)
        {
            if (empty($item))
            {
                unset($params[$k]);
            }
        }


        $obj_name =  $current_rule['components'][0]['object'] ?? null;
        if ($obj_name)
        {
            $obj = new $obj_name($params);
            $obj->execute();
        }

        if (!isset($params['controller'])  )
        {

            $dashbord = new DashbordComponent($params);
            $dashbord->execute();

        }

        if ($params['controller'] && $params['controller'] == 'rest')
        {

            $controller = new RestBaseController($params);
            if ($custom_method = $params['action'])
            {

                $controller->$custom_method();
            }else{

                $controller->execute();
            }
        }
    }
}