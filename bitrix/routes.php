<?php
$routes = [

    [
        'name'=>'admin',
        "condition"=>"#^/admin/([a-z-]+)?(?:/([a-z0-9]+)?)?(?:/([a-z0-9-]+)?)/?$#i",
        'rule'=>"page=admin&object=$1&action=$2&element_code=$3",
        'component'=>['varible'=>['element_code']]


    ],
    [
        "condition"=>"#^/admin/?$#i",
        'rule'=>"page=admin&object=home&action=index"
    ],

    [
        "condition"=>"#^/api/([a-z-]+)?(?:/([a-z-]+)?)?(?:/([a-z-]+)?)?(?:/(\?.*)?)/?$#i",
        'rule'=>"controller=rest&object=$1&action=$2"
    ],

    [
        'condition'=>"#^/blog/?$#i",
        'rule'=>'page=blog&object=category',
        'components'=>[
            [
                'object'=>\components\Catalog\CategoryComponent::class,
                'section'=>"",
                'element_code'=>""
            ]
        ]
    ],

    [
        'condition'=>"#^/blog/?(?:/([a-z-]+)?)(?:/([a-z0-9-]+)?)/?$#i",
        'rule'=>'page=blog&section_code=$1&element_code=$2',
        'components'=>[
           [
            'object'=>\components\Catalog\CategoryComponent::class,
            'section_code'=>"",
            'element_code'=>""
           ]
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