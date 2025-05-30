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
            'rule'=>'controller=Home&action=main&section=$1'
        ],

        [
            'condition'=>'#^/([a-z]+)/?([^\\/]+)?$#',
            'rule'=>'controller=Home&action=main&section=$1'
        ],

        [
            'condition'=>'#^/([a-z]+)/([a-z0-9]+)/?$#',
            'rule'=>'controller=Home&action=sectionList&section=$1&postCode=$2'
        ],



        [
            'condition'=>'#^/([a-z]+)/([a-z]+)/?$#',
            'rule'=>'controller=Home&action=section&section=$1&postCode=$2'
        ],



        [
            'condition'=>'#^/api/([a-z]+)/([^\\/]+)/?$#',
            'rule'=>'controller=$1',
            'isRest'=>'y'
        ],

        [
            'condition'=>'#^/api/([a-z]+)/?$#',
            'rule'=>'controller=$1',
            'isRest'=>'y'
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
        $getParams = parse_str($rule,$resArrGetParams);
        if (isset($current_rules['isRest']))
        {
            $app->checkMethod($resArrGetParams['controller'],$resArrGetParams);
        }else{
            $controller = '\\controllers\\'.$resArrGetParams['controller'].'Controller';
            $action = 'action'.$resArrGetParams['action'];
            if (class_exists($controller))
            {
                $oController = new $controller();
                $request = new Request();
                $oController->$action($request);
            }else{
                echo 404;
            }

        }
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