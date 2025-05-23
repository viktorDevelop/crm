<?php

return $routes = [
        [
            'condition'=>'#^/#',
            'rule'=>'',
            'controller'=>\crm\controllers\PageController::class,
            'method'=>'index',
            'rest'=>['page']
        ],

        [
            'condition'=>'#^/posts/?([^\\/]+)/?$#',
            'rule'=>'page=$2',
            'controller'=> \crm\controllers\PostController::class,
            'method'=>'index',
            'rest'=>['get']
        ],

//        [
//            'condition'=>'#^/posts/?$#',
//            'rule'=>'page=$2',
//            'controller'=> \crm\controllers\PostController::class,
//            'method'=>'posts',
//            'rest'=>['get']
//        ],
//
//        [
//            'condition'=>'#^/category/([a-z0-9-]+)/?([^\\/]+)/?$#',
//            'rule'=>'section_code=$1&page=$2',
//            'controller'=> \crm\controllers\CategoryController::class,
//            'method'=>'posts',
//            'rest'=>['get']
//        ]

];


