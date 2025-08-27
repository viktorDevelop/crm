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
        'type'=>'blog',
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
                'template'=>'blog/posts/detail',
            ]
        ]
    ],

    [   // статичная страница, контент хранится в таблице с pages (field content)
        'condition' => '#^/(contact)?(?:/(\?.*)?)?$#i',
        'rule'=>'section_code=$2&element_code=$3',
        'components'=>[
            'section'=>[
                'componentClass'=>\components\posts\PostsElements::class,
                'template'=>'blog/posts/list',
            ],
            'list'=>[

            ],
            'detail'=>[]
        ]
    ],

    [
        'condition' => '#^/(admin-page)(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
        'rule'=>'section_code=$2&element_code=$3',
        'type'=>'admin',
        'autorization'=>[
            'role'=>['admin']
        ],
        'components'=>[
            'section'=>[
                'componentClass'=>\components\pages\PageList::class,
                'template'=>'admin/pages'
            ]

        ]
    ],


];


\core\Application::run($routes);




