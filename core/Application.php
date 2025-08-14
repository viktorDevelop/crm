<?php
namespace core;

class Application
{
    public static function run()
    {
        $routes = [
            [
                'condition'=>'#^/api/([a-z-]+)/?$#',
                'rule'=>'handler=$1'
            ],


            [
                'condition' => '#^/([category]+)(?:/([a-z-]+))?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
                'rule'=>'section_code=$2&element_code=$3',
                'components'=>[
                    [
                        'category'=>Category::class
                    ]
                ]
            ],

        ];
        $uri = $_SERVER['REQUEST_URI'];
        foreach ($routes as $k=>$item)
        {
            if (preg_match($item['condition'],$uri))
            {
                $rule = preg_replace($item['condition'],$item['rule'],$uri);
                $current_rules = $item;
            }
        }

        parse_str($rule,$resArrGetParams);
        var_dump($current_rules['components']);
    }
}