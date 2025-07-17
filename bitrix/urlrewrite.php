<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

//\core\Application::run();


class Router
{
    protected $routes = [

        [
            'condition'=>'#^/$#',
            'rule'=>'controller=Page&action=execute&component=Home,reviews,gallery'
        ],


        [
            'condition'=>'#^/([a-z]+)/?$#',
            'rule'=>'controller=Page&action=execute&component=$1'
        ],

        [
            'condition'=>'#^/([a-z]+)/([a-z]+)(?:/?([a-z0-9-]+)?/?(\?.*)?$|$)#',
            'rule'=>'controller=$1&action=page&section=$2&slug2=$3'
        ]


    ];

    protected function getRoutes()
    {

    }
}



