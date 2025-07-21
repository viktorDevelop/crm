<?php

namespace apptest;

use apptest\components\category\CategoryService;

class App
{
    public static function run()
    {
        $routes = [
            [
                "condition"=>"#^/$#",
                "rule"=>"",
                'handle'=>DefaultModule::class,
                'type'=>'isPublic'
            ],

            [
                "condition"=>"#^/([a-z]+)/?$#",
                "rule"=>"component=$1",
                'handle'=>DefaultModule::class,
                'type'=>'isPublic',
                'components'=>[
                    [
                        'class'=>CategoryService::class,
                        'view'=>'blog.category.list'
                    ],
                    [
                        'class'=>CategoryService::class,
                        'view'=>'blog.category.top'
                    ]
                ],
            ],
            [
                "condition"=>"#^/([a-z-]+)/([a-z-]+)/?$#",
                "rule"=>"component=$1&section_code=$2",
                'handle'=>DefaultModule::class,
                'type'=>'isPublic'
            ],
            [
                "condition"=>"#^/([a-z-]+)/([a-z-]+)/([a-z0-9-]+)/?$#",
                "rule"=>"component=$1&section_code=$2&element_code=$3",
                'handle'=>DefaultModule::class,
                'type'=>'isPublic'
            ],
            [
                "condition"=>"#^/api/([a-z]+)/?$#",
                "rule"=>"",
                'handle'=>RestModule::class,
                'type'=>'isRest'
            ],
            [
                "condition"=>"#^/admin/?$#",
                "rule"=>"",
                'components'=>[

                ],
                'type'=>'isAdmin'
            ]
        ];


        $uri = $_SERVER['REQUEST_URI'];
        foreach ($routes as $items)
        {
            if (preg_match($items['condition'],$uri))
            {
                $rule = preg_replace($items['condition'],$items['rule'],$uri);
                $current_rules = $items;
            }
            parse_str($rule,$resArrGetParams);
        }
        var_dump($resArrGetParams);

        $defMod = new DefaultModule();
        $restMod = new RestModule();
        $adminMod = new AdminModule();
        $defMod->setNext($restMod)->setNext($adminMod);
        $defMod->handle($current_rules['type'],$current_rules,$resArrGetParams);
    }
}