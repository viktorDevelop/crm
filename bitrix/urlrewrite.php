<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

$routes = [
    [
        'condition'=>'#^/api/([a-z-]+)/?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
        'rule'=>'handler=$1&id=$2',
        'rest'=>true
    ],
    [
        'condition' => '#^/(category)(?:/([a-z0-9-]+))?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
        'rule'=>'section_code=$2&element_code=$3',
        'components'=>[
            'section'=>[
                'componentClass'=>\components\category\CategoryList::class,
                'template'=>'blog/category/list',

            ],
            'list'=>[
                'componentClass'=>\components\posts\PostsList::class,
                'template'=>'blog/posts/list',
            ],
            'detail'=>[
                'componentClass'=>\components\posts\PostsElements::class,
                'template'=>'blog/posts/list',
            ]
        ]
    ],

    [
        'condition' => '#^/(admin-page-new)(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
        'rule'=>'section_code=$2&element_code=$3',
        'aurization'=>[
            'role'=>['admin']
        ],
        'components'=>[
            'section'=>[

            ],
            'list'=>[],
            'detail'=>[]
        ]
    ],


];


\core\Application::run($routes);




