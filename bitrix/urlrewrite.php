<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

//$router = [
//    [
//        'condition'=>'/',
//        'rule'=>"",
//        'auth'=>false
//    ],
//    [
//        'condition'=>'#^/blog/?(?:/([a-z0-9-]+))?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
//        'rule'=>"section_code=$1&element_code=$2",
//        'controller'=>\services\categoryViewer\controller::class,
//        'auth'=>false,
//        'components'=> []
//    ],
//    [   // about
//        'condition'=>'#^/about/?(?:\(\?.*)?)?$#i',
//        'rule'=>"",
//        'auth'=>false,
//        'components'=> []
//    ],
//    [
//        'condition'=>'#^/admin/user/?(?:/([a-z0-9-]+))?(?:/([\?.*])?)?$#i',
//        'rule'=>"section_code=user&element_code=$1",
//        'controller'=>services\user\controller::class,
//        'auth'=>true,
//    ],
//    [
//        'condition'=>'#^/user/autorize/?$#i',
//        'rule'=>"",
//        'controller'=>services\user\controller::class,
//
//    ]
//];
//
//
//
//\core\Application::run($router);