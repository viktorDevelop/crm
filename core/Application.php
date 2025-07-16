<?php
namespace core;
use core\Request;


class Application
{
    protected $routes = [

        [
            'condition'=>'#^/$#',
            'rule'=>'controller=Page&action=execute&component=Home,reviews,gallery'
        ],


        [
            'condition'=>'#^/([a-z]+)/?$#',
            'rule'=>'controller=Page&action=execute&component=$1'
        ],

        [
            'condition'=>'#^/([a-z]+)/([a-z]+)(?:/?([a-z0-9-]+)?/?(\?.*)?$|$)#',
            'rule'=>'controller=$1&action=page&section=$2&slug2=$3'
        ],
        [
            'condition'=>'#^/admin/?$#',
            'rule'=>'controller=Admin&action=execute&component=catalog,reviews,gallery'
        ],

    ];
    public static function run()
    {
        $app = new self();
        $uri = $_SERVER['REQUEST_URI'];

        foreach ($app->routes as $k => $items)
        {
            if (preg_match($items['condition'],$uri))
            {
                $rule = preg_replace($items['condition'],$items['rule'],$uri);
                $current_rules = $items;
            }
        }
//        print_r($rule);
        $getParams = parse_str($rule,$resArrGetParams);

        if (isset($current_rules['isRest']))
        {
            $app->checkMethod($resArrGetParams['controller'],$resArrGetParams);
        }else{
              $controller = '\\controllers\\'.ucfirst($resArrGetParams['controller']).'Controller';
              $action = 'action'.$resArrGetParams['action'];

            if (class_exists($controller))
            {
                $oController = new $controller($resArrGetParams);
                $request = new Request();
                $oController->$action($request);
            }else{
                echo 404;
            }

        }
    }

    private function dump($ar = [])
    {
        echo '<pre>';  print_r($ar);
    }


    protected function checkMethod($controller,$params = [])
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $obj_name =   '\\controllers\\rest\\'.ucfirst($controller).'Controller';

        $handler = \core\helpers\HandlerFactory\HandlerFactory::create($method,$obj_name);
        echo  $handler->handle();

    }

}