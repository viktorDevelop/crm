<?php
include "init.php";

define('BASE_URL',$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']);
define('TEMPLATE_PATH',BASE_URL.'/templates/blog/');

\core\Application::run();


//echo '<pre>';
//print_r($_SERVER);
//
//$page = $_GET['page'] ?: 'index';
//$uri = $_SERVER['REQUEST_URI'];
//$menu = [
//    [
//        'title'=>'главная',
//        'url'=>'page=index',
//        'condition'=>'#^/#i',
//
//    ],
//    [
//        'title'=>'список постов пользователя',
//        'condition'=>'#^$#i',
//        'rule'=>'page=posts&user_id=$1',
//
//    ],
//
//    [
//        'title'=>'детальная поста',
//        'condition'=>'#^$#i',
//        'rule'=>'page=post&post_code=$1',
//
//    ],
//
//    [
//        'title'=>'авторизация',
//        'condition'=>'#^$#i',
//        'rule'=>'page=login&post_code=$1',
//
//    ],
//
//    [
//        'title'=>'выход',
//        'condition'=>'#^$#i',
//        'rule'=>'page=exit',
//
//    ],
//
//    [
//        'title'=>'регистрация',
//        'condition'=>'#^$#i',
//        'rule'=>'handle=user&action=registration',
//
//    ],
//
//
//];
//
//$setting_page = [
//    'blog'=>[
//        'components'=>[
//            'pular.posts'=>[
//                'collectionList'=>[
//                    'model'=>'posts@pular'
//                ]
//            ],
//            'rating.bloger'=>[
//                'collectionList'=>['model'=>'posts@rating']
//            ]
//        ]
//    ]
//];
//
//
//switch ($page)
//{
//    case 'index':
//    {
//        $title = 'главная';
//        break;
//    }
//
//    case 'posts':
//    {
//        $title = 'посты пользователя '.$_GET['category'];;
//        break;
//    }
//    case 'post':
//    {
//        $title = 'пост детальная id | post_code = '.$_GET['category'];;
//        break;
//    }
//
//    case 'login':
//    {
//        $title = 'авторизация';
//        break;
//    }
//
//    case 'exit':
//    {
//        $title = 'выход';
//        break;
//    }
//
//    case 'registration':
//    {
//        if ($_SERVER['REQUEST_METHOD'] != 'POST')
//            die();
//
//        $title = 'регистрация';
//        break;
//    }
//
//    default:{
//        echo '404';
//    }
//}
//include  $_SERVER['DOCUMENT_ROOT'].'/templates/blog/template.php';

//$comp = new \services\models\Components();
//
//$comp->id = 3;
//$comp->title = 'test111';
//$comp->template = 'test';
//$comp->object = 'test';
//$comp->page_id = 1;
//$comp->params = 1;
//
////var_dump($comp);
//
//$orm = new \core\SimpleOrm(\services\models\Components::class);
//$orm->save($comp);