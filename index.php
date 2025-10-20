<?php
include "init.php";

define('BASE_URL',$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']);
define('TEMPLATE_PATH',BASE_URL.'/templates/blog/');

\core\Application::run();
