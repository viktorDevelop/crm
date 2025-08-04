<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

//$routes = include '../config/routes.php';
//
//\core\Application::run($routes);

/** @var  $view \core\View */
$view = \core\View::getInstance();

class Posts extends \core\SimpleORM
{
    public ?int $id;
    public string $title;
    public string $content;
    public string $preview;

    public function __construct()
    {
        parent::__construct(self::class);
    }
}

$post = new Posts();
$post->findAll();
$res = $post->toArray();

echo $view->render('blog',[
    'postData'=>$res
]);