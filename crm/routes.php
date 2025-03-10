<?php

return $routes = [
        [
            'condition'=>'#^/#',
            'rule'=>'section=10&post=20',
            'controller'=>\crm\controllers\CategoryController::class,
            'method'=>'index',
            'rest'=>['get']
        ],
        [
            'condition'=>'#^/([a-z0-9-]+)/?([^\\/]+)/?$#',
            'rule'=>'section_code=$1&page=$2',
            'controller'=> \crm\controllers\CategoryController::class,
            'method'=>'posts',
            'rest'=>['get']
        ],
//
//        [
//            'condition'=>'#^/([a-z0-9-]+)/([a-z0-9]+)/?$#',
//            'rule'=>'controller=category&section_code=$1&post_code=$2',
//            'controller'=> \medical\controllers\CategoryController::class,
//            'method'=>'index',
//            'rest'=>['get','post']
//        ],
//        [
//            'condition'=>'#^/category/([a-z0-9-]+)/?$#',
//            'rule'=>'section_code=$1',
//            'controller'=>\medical\controllers\CategoryController::class,
//            'method'=>'index',
//            'rest'=>['get']
//        ],
];


