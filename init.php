<?php
session_start();
spl_autoload_register(function ($class){
    $path = $_SERVER['DOCUMENT_ROOT'].'/'.str_replace('\\','/',$class);
    $path .= '.php';
    if (file_exists($path)){
        include $path;
    }

});

//ini_set('display_errors', 0);
//error_reporting(E_ALL);
////
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




function findClassByName($className, $directory) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory)
    );

    $found = [];

    foreach ($iterator as $file) {
        if ($file->getExtension() === 'php') {
            $content = file_get_contents($file->getPathname());

            // Простой поиск по паттерну
            if (preg_match('/class\s+' . preg_quote($className) . '\s/', $content)) {
                $found[] = $file->getPathname();
            }

            // Более точный поиск с пространством имен
            if (preg_match('/namespace\s+([^;]+);.*class\s+' . preg_quote($className) . '/s', $content, $matches)) {
//                $found[] = $file->getPathname() . " (namespace: {$matches[1]})";
                $found['namespace'] = $matches[1];
            }
        }
    }

    return $found;
}

// Использование
//$results = findClassByName('PagesRestController', __DIR__ . '/components');
//send2Log($results);

function send2Log($arr,$print = true)
{
    echo '<pre>';
     print_r($arr);
}