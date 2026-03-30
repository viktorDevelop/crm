<?php
namespace core;




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

       $p = self::init($params,$current_rule);

//        $obj_name =  $current_rule['components'][0]['object'] ?? null;
//
//        if ($obj_name)
//        {
//
//            $obj = new $obj_name($params);
//            $obj->execute();
//        }

//        if (!isset($params['controller'])  )
//        {
//
//            $dashbord = new DashbordComponent($params);
//            $dashbord->execute();
//
//        }
//
//        if ($params['controller'] && $params['controller'] == 'rest')
//        {
//
//            $controller = new RestBaseController($params);
//            if ($custom_method = $params['action'])
//            {
//                $controller->$custom_method();
//            }else{
//
//                $controller->execute();
//            }
//        }
    }

    private static function init($params = [],$current_rule = [])
    {
        if (!$params) return false;

        $obj_name_default =  $current_rule['components']['default'] ?? null;
        $aStates = $current_rule['components']['states'];

        if ($aStates)
        {
            foreach ($params as  $k => $items)
            {
                $current_state = $aStates[$k] ?? $aStates['default'];

            }
        }
        if ($current_rule['components']['object'])
        {
            $obn = ucfirst($params['object']);
            $current_state = $current_rule['components']['object'].$obn."\\".ucfirst($params['object']).'Controller';
            $action = $params['action'] ?? 'view';
        }

        if ($params['controller'] == 'rest')
        {
            $cl = ucfirst($params['object']). ucfirst($params['controller']).'Controller';
            $findClassByName = findClassByName($cl,$_SERVER['DOCUMENT_ROOT'].'/components');

            $obj_name_default = RestBaseController::class;
            $current_state = $findClassByName['namespace'].'\\'.$cl ?? null;
        }


        send2Log([
            '$p'=>$params,

            "current_rule"=>$current_rule,
           "current_state"=> $current_state,
           "findClassByName"=> $findClassByName,
            "obj_name_default"=>$obj_name_default,

        ]);


        $obj_name_default = new $obj_name_default($current_state,$params);
        $obj_name_default->execute();



    }
}