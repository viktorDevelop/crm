<?php
session_start();
spl_autoload_register(function ($class){
    $path = $_SERVER['DOCUMENT_ROOT'].'/'.str_replace('\\','/',$class);
    $path .= '.php';
    if (file_exists($path)){
        include $path;
    }

});
