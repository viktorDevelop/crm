<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
$routes = include $_SERVER['DOCUMENT_ROOT'].'/crm/routes.php';

//include $_SERVER['DOCUMENT_ROOT'].'/templates/template.php';
//(new \crm\core\Router($routes));

\core\Application::run();

// get user/
// get user/{id}
// get user/{id}/posts
// POST user/
// PUT user
// DELETE user/{id}

// get posts/
// get posts/{id}
// get posts/{id}/comment
// POST posts/
// PUT posts
// DELETE posts/{id}

