<?php

return [
    [
        'condition'=>'#^/$#',
        'rule'=>'',
        'components'=>[
                [
                    'className'=>\components\ComponentList::class,
                    'params'=>[
                            'limit'=>6,
                            'pagen'=>true,
                            'comment'=>true,
                            'model'=>Posts::class
                    ]
            ]
        ]
    ],

    [
        'condition'=>'#^/category/([a-z-]+)/?$#',
        'rule'=>'category_code=$1',
        'components'=>[
            [
                'className'=>\components\ComponentItems::class,
                'params'=>[
                    'limit'=>6,
                    'pagen'=>true,
                    'comment'=>true,
                    'model'=>Posts::class,
                    'varible'=>[
                        'category_code'
                    ]
                ]
            ]
        ]
    ],

    [
        'condition'=>'#^/category/([a-z-]+)/([a-z0-9-]+)/?$#',
        'rule'=>'category_code=$1&element_code=$2',
        'components'=>[
            [
                'className'=>\components\ComponentItems::class,
                'params'=>[
                    'limit'=>6,
                    'pagen'=>true,
                    'comment'=>true,
                    'model'=>Posts::class,
                    'varible'=>[
                        'category_code',
                        'element_code'
                    ]
                ]
            ]
        ]
    ],

    [
        'condition'=>'#^/api/([a-z-]+)/([a-z-]+)/?$#',
        'rule'=>'category_code=$1',
        'handle'=>\controllers\PageController::class,
        'components'=>[
            ['className'=>PostsTop::class,'params'=>['limit'=>6] ],

        ]
    ],

];