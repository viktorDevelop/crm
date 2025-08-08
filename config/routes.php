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
        'condition'=>'#^/admin/page/new/?$#',
        'rule'=>'',
        'components' => [
            [
                'className'=>\modules\page\components\PageList::class,
                'template'=>'admin/PageList',
            ]
        ]
    ],


    [
        'condition'=>'#^/category/([a-z-]+)/?$#',
        'rule'=>'category_code=$1',
        'components'=>[
            [
                'className'=>\modules\posts\components\PostList::class,
                'template'=>'blocks',
                'params'=>[
                    'limit'=>2,
                    'varible'=>[
                        'category_code'
                    ]
                ]
            ]
        ]
    ],

    [
        'condition'=>'#^/category/([a-z-]+)/([a-z0-9-]+)/?$#',
        'rule'=>'section_code=$1&element_code=$2',
        'components'=>[
            [
                'className'=>\modules\posts\components\PostItem::class,
                'params'=>[
                    'template'=>'blocks',
                    'comment'=>true,
                    'varible'=>[
                        'category_code',
                        'element_code'
                    ]
                ]
            ]
        ]
    ],



    [
        'condition'=>'#^/api/([a-z-]+)/?$#',
        'rule'=>'handle=$1'
    ],

    [
        'condition'=>'#^/api/([a-z-]+)/([0-9]+)/?$#',
        'rule'=>'handle=$1&id=$2'
    ],


];