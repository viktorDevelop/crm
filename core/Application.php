<?php
namespace core;

class Application
{

    public static function run($routes)
    {

        $uri = $_SERVER['REQUEST_URI'];
        foreach ($routes as $k=>$item)
        {
            if (preg_match($item['condition'],$uri))
            {
                $rule = preg_replace($item['condition'],$item['rule'],$uri);
                $curent_rule = $item;
            }
        }
        parse_str($rule,$arUrlParams);
        if (empty($curent_rule))
            http_response_code(404);

        $request = new Request($arUrlParams);

//        echo '<pre>';
//        var_dump($arUrlParams);

        $configPage = new PageConfigHelper;
        $configPage->components = (isset($curent_rule['components'])) ? $curent_rule['components'] : null;
        $configPage->isRest =  isset($arUrlParams['handle']) ?? null;
        $configPage->Request  = $request;

        HandleFabrica::create($configPage);
    }



}