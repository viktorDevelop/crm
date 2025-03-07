<?php
session_start();
spl_autoload_register(function ($class){
    $path = $_SERVER['DOCUMENT_ROOT'].'/'.str_replace('\\','/',$class);
    $path .= '.php';
    if (file_exists($path)){
        include $path;
    }

});

//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//
//function shutdown() {
//    $error = error_get_last();
//    if (
//        is_array($error) &&
//        in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])
//    ) {
//        // очищаем буфер вывода (о нём мы ещё поговорим в последующих статьях)
//        while (ob_get_level()) {
//            ob_end_clean();
//        }
//        // выводим описание проблемы
//        echo 'Сервер находится на техническом обслуживании, зайдите позже';
//    }
//}
//register_shutdown_function('shutdown');

