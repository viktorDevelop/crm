<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

$routes = [
    [
        'condition'=>'#^/api/([a-z-]+)/?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
        'rule'=>'handler=$1&id=$2',
        'rest'=>true
    ],

    [
        'condition'=>'#^/api/user/autorizate/?$#',
        'rule'=>'',
        'method'=>'post',
        'action'=>'autorizate',
        'handler'=>\components\users\UsersRestService::class,
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
        'condition' => '#^/auth/?$#',
        'rule'=>'',
        'type'=>'blog',
        'components'=>[
            'section'=>[
                'componentClass'=>\components\users\autorization\Auth::class,
                'template'=>'blog/forms/auth'
            ]
        ]
    ],

    [
        'condition' => '#^/(admin-page)(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
        'rule'=>'section_code=$2&element_code=$3',
        'type'=>'admin',
        'autorization'=>[
            'role'=>['admin','supervizer']
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


//$user = new \components\users\Users();
//
//$user->model->find(2);
//$res = $user->model->toArray();
//print_r($res);
//$user->find(1);

//$user->login = 'admin';
//$user->role = json_encode(['admin']);
//$user->name = 'viktor';
//$user->phone = '89507778899';
//$user->password = md5(sha1(123456));
////$user->save($user);
//
//$orm  = new \core\SimpleOrm(\components\users\Users::class);
//$orm->save($user);




