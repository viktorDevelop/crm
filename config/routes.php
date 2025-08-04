<?php

return [
    [
        'condition'=>'#^/$#',
        'rule'=>'',
        'handle'=>\controllers\PageController::class,
        'components'=>[
            ['className'=>PostsTop::class,'params'=>['limit'=>6] ]
        ]
    ],
    [
        'condition'=>'#^/api/category/?$#',
        'rule'=>'',
        'handle'=>\controllers\PageController::class,
        'resource'=>true
    ],

    [
        'condition'=>'#^/category/([a-z-]+)/?$#',
        'rule'=>'category_code=$1',
        'handle'=>\controllers\PageController::class,
        'components'=>[
            ['className'=>PostsTop::class,'params'=>['limit'=>6] ],
        ]
    ],

    [
        'condition'=>'#^/api/([a-z-]+)/([a-z-]+)/?$#',
        'rule'=>'category_code=$1',
        'handle'=>\controllers\PageController::class,
        'components'=>[
            ['className'=>PostsTop::class,'params'=>['limit'=>6] ],

        ]
    ],

];