<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

$router = [
    [
        'condition'=>'/',
        'rule'=>"",
        'auth'=>false
    ],
    [
        'condition'=>'#^/blog/?(?:/([a-z0-9-]+))?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
        'rule'=>"section_code=$1&element_code=$2",
        'controller'=>\services\categoryViewer\controller::class,
        'template'=>'blog/articles',
        'auth'=>false,
        'components'=> []
    ],
    [   // about
        'condition'=>'#^/about/?(?:\(\?.*)?)?$#i',
        'rule'=>"",
        'auth'=>false,
        'components'=> []
    ],
    [
        'condition'=>'#^/admin/user/?(?:/([a-z0-9-]+))?(?:/([\?.*])?)?$#i',
        'rule'=>"section_code=user&element_code=$1",
        'template_section'=>'',
        'template_items'=>'',
        'template_detail'=>'',
        'controller'=>services\user\controller::class,
        'auth'=>true,
        'state_items'=>'',
        'state_detail'=>'',
        'components'=>[]
    ],
    [
        'condition'=>'#^/user/autorize/?$#i',
        'rule'=>"",
        'template_section'=>'',
        'template_items'=>'',
        'template_detail'=>'',
        'controller'=>services\user\controller::class,
        'auth'=>true,
        'state_items'=>'',
        'state_detail'=>'',
        'components'=>[]
    ]
];



\core\Application::run($router);