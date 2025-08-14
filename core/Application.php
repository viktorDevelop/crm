<?php
namespace core;


class Application
{
    public static function run()
    {
        $routes = [
            [
                'condition'=>'#^/api/([a-z-]+)/?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
                'rule'=>'handler=$1&id=$2',
                'rest'=>true
            ],


            [
                'condition' => '#^/([category]+)(?:/([a-z-]+))?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
                'rule'=>'section_code=$2&element_code=$3',
                'components'=>[
                    [
                        'componentClass'=>\modules\category\components\CategoryComponent::class,
                        'params'=>['pagen'=>true,'limit'=>10]
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

        $page_c = new \PageController($current_rules);
        $page_c->execute();
        if ($current_rules['rest']){
            $object = $resArrGetParams['handler'];
           echo HandlerFactory::create($object);

        }


    }
}
