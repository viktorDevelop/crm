<?php
namespace core;

use services\categoryViewer\states\SectionList;

class Application
{
    public static $isHiddenPage = false;

    public static function run($router)
    {
        $uri = $_SERVER['REQUEST_URI'];
        foreach ($router as $k=> $item)
        {
            if (preg_match($item['condition'],$uri))
            {
                $rule = preg_replace($item['condition'],$item['rule'],$uri);
                $current_rules = $item;

            }
        }

        parse_str($rule,$requestParams);

        if (!$current_rules){
            echo 404; die();
        }

        $request = new \core\Request($requestParams);
        $controller = $current_rules['controller'] ?? null;
        self::$isHiddenPage  = $current_rules['auth'] ?? false;
        if ($controller)
        {
            $nameSpaceState = new \ReflectionClass($controller);
            $sNameSpaceState =  $nameSpaceState->getNamespaceName();
            $sNameSpaceState .= '\\states';

            $section_code = $requestParams['section_code'] ?? null;
            $element_code = $requestParams['element_code'] ?? null;

            $state = new CurrentState($section_code,$element_code,$sNameSpaceState,$current_rules['template']);
            $current_state = $state->getState();

            $oController = new $controller($current_state);
            echo  $oController->actionShowPage($request);
        }

    }
}