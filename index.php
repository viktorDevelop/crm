<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

$routes = include 'config/routes.php';
\core\Application::run($routes);;

// авторизация
// из пост запроса приходит логин и пароль
// находим пользователя по ним
//
// если не найден:
//   сообщение messege(unauthorised)
// иначе
// генерируем token, шифруем его роль, id, и массив доступов, сохраняем в сессию
// $_SESSTION['USER_ID] $_SESSION['TOKEN] = ''

//Аутентификация
// находим пользователя по id ($_SESSTION['USER_ID])
// получаем private_key
//  token - {'user_id':1,role:private} шифруем/дешифруем hash паролем
//  проверяем

//регистрация

