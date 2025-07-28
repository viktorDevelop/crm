<?php
return
    [
        [
            'condition'=>'#^/$#',
            'rule'=>'section_code=$1',
            'handler'=>\controllers\CategoryController::class,
            'type'=>'',
            'components'=> []
        ],

        [
            'condition'=>'#^/category/([a-z0-9]+)/?$#',
            'rule'=>'section_code=$1',
            'handler'=>\controllers\CategoryController::class,
            'type'=>'',
            'components'=> [
                [
                    'component_class'=>\components\Comment\CommentForm::class
                ],
                [
                    'component_class'=>\components\Comment\CommentList::class
                ]
            ]
        ],

        [
            'condition'=>'#^/registation/?$#',
            'rule'=>'',
            'handler'=>\controllers\Registation::class,
            'type'=>'',
            'components'=> [
              [  'component_class'=> \components\registration\form\Registration::class]
            ]
        ],


        [
            'condition'=>'#^/autorizate/?$#',
            'rule'=>'',
            'handler'=>\controllers\AutorizateController::class,
            'type'=>'',
            'components'=> [
                [  'component_class'=> \components\autorizate\form\Autorizate::class]
            ]
        ],
        [
            'condition'=>'#^/api/category/?$#',
            'rule'=>'',
            'handler'=>\controllers\CategoryController::class,
            'type'=>'rest',
            'components'=> []
        ]
    ];

