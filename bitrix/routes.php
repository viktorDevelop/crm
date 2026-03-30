<?php

use core\CatalogBaseController;

$routes = [

    [
        'name'=>'admin',
        "condition"=>"#^/admin/([a-z-]+)?(?:/([a-z0-9]+)?)?(?:/([a-z0-9-]+)?)/?$#i",
        'rule'=>"page=admin&object=$1&action=$2&element_code=$3",
        'components'=>[
            'default'=>\core\DashbordBaseController::class,
            'object'=>"\\components\\Admin\\Dashboard\\"
        ]

    ],
    [

        "condition"=>"#^/(authorization)/?$#i",
        'rule'=>"page=authorization&object=$1",
        'components'=>[
            'default'=>\core\CatalogBaseController::class,
            'object'=>"\\components\\"
        ]

    ],

    [
        "condition"=>"#^/admin/?$#i",
        'rule'=>"page=admin&object=home&action=index",
        'components'=>[
            'default'=>\core\DashbordBaseController::class,
            'object'=>"\\components\\Admin\\Dashboard\\"
        ]
    ],

    [
        "condition"=>"#^/api/([a-z-]+)?(?:/([a-z-]+)?)?(?:/([a-z-]+)?)?(?:/(\?.*)?)/?$#i",
        'rule'=>"controller=rest&object=$1&action=$2"
    ],
    [
        "condition"=>"#^/signin/?$#i",
        "rule"=>"page=auth",
        'components'=>
              [
                'default'=>\core\SinglePageBaseController::class,
                'states'=>[
                    'default'=>\components\Autorization\AuthorizationController::class
                ]

            ]

    ],

    [
        'condition'=>"#^/blog/?(?:/([a-z-]+)?)?(?:/([a-z0-9-]+)?)/?$#i",
        'rule'=>'page=blog&section_code=$1&element_code=$2',
        'components'=>[
            'default'=>\core\CatalogBaseController::class,
            'states'=>[
                'default'=>\components\Catalog\CategoryListComponent::class,
                'section_code'=>\components\Catalog\PostListComponent::class,
                'element_code'=>\components\Catalog\PostItemComponent::class
            ],
        ]
    ],

    [
        'condition'=>"#^/(about)/?$#i",
        'rule'=>'page=blog&section=$1',
        'component'=>[
            'object'=>Section::class
        ]
    ]

];

return $routes;