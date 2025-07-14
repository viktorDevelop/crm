<?php
namespace core;
use core\Request;


class Application
{
    protected $routes = [

        [
            'condition'=>'#^/$#',
            'rule'=>'controller=Home&action=main&section=$1'
        ],

        [
            'condition'=>'#^/([a-z]+)/?$#',
            'rule'=>'controller=$1&action=main'
        ],

        [
            'condition'=>'#^/([a-z]+)/([a-z]+)(?:/?([a-z0-9-]+)?/?(\?.*)?$|$)#',
            'rule'=>'controller=$1&action=page&section=$2&slug2=$3'
        ],

//        [
//            'condition'=>'#^/admin/$#',
//            'rule'=>'controller=Admin&action=main&section=$1'
//        ],
//
//        [
//            'condition'=>'#^/admin/([a-z]+)/?$#',
//            'rule'=>'controller=$1&action=main'
//        ],
//
//        [
//            'condition'=>'#^/admin/([a-z]+)/([a-z]+)(?:/?([a-z0-9-]+)?/?(\?.*)?$|$)#',
//            'rule'=>'controller=$1&action=page&section=$2&slug2=$3'
//        ],

        [
            'condition'=>'#^/api/([a-z]+)/([^\\/]+)/?$#',
            'rule'=>'controller=$1',
            'isRest'=>'y'
        ]
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
        switch ($method){
            case 'GET':

                if (class_exists($obj_name))
                {
                    $obj_name = new $obj_name();
                    $action = 'actionIndex';
                    $request = new Request();
                    echo $obj_name->$action($request);
                }else{
                    echo 404;
                }
            break;
            case 'PATCH':
            case 'PUT':
            case 'POST':

                if (class_exists($obj_name))
                {
                    $obj_name = new $obj_name();
                    $action = 'actionSave';
                    $request = new Request();
                    echo  $obj_name->$action($request);

                }else{
                    echo 404;
                }
                break;
            case 'DELETE':

                if (class_exists($obj_name)){
                    $obj_name = new $obj_name();
                    $action = 'actionDelete';
                    $request = new Request();
                    echo $obj_name->$action($request);
                }else{
                    echo 404;
                }
                break;

            default:
                throw new \Exception('Unexpected value');
        }
    }

}