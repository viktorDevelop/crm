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
                'condition' => '#^/([category]+)(?:/([a-z0-9-]+))?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
                'rule'=>'section_code=$2&element_code=$3',
                'components'=>[

                        'componentClass'=>\modules\category\components\CategoryComponent::class,
                        'params'=>[
                            'sectionList'=>[
                                'limit'=>10,
                                'template'=>'blog/category/blocks',
                                'model'=>\modules\category\Category::class
                            ],
                            'itemList'=>[
                                'limit'=>5,
                                'template'=>'blog/posts/blocks',
                                'model'=>''
                            ],
                            'item'=>[
                                'template'=>'blog/posts/items'
                            ]

                        ]

                ]
            ],
            [
                'condition' => '#^/([contact]+)(?:/([a-z0-9-]+))?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
                'rule'=>'section_code=$2&element_code=$3',
                'components'=>[

                    'componentClass'=>\modules\category\components\CategoryComponent::class,
                    'params'=>[
                        'sectionList'=>[
                            'limit'=>10,
                            'template'=>'blog/category/blocks',
                            'model'=>\modules\category\Category::class
                        ],
                        'itemList'=>[
                            'limit'=>5,
                            'template'=>'blog/posts/blocks',
                            'model'=>''
                        ],
                        'item'=>[
                            'template'=>'blog/posts/items'
                        ]

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

        $page_c = new \PageController($current_rules,$resArrGetParams);
        $page_c->execute();
        if ($current_rules['rest']){
            $object = $resArrGetParams['handler'];
           echo HandlerFactory::create($object);

        }
    }
}
