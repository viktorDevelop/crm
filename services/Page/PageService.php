<?php
namespace services\Page;

use services\models\Pages;

class PageService
{
    public static function getRoutes()
    {
        $mPage = new Pages();
        $mPage->model->findAll();
        return $mPage->model->toArray();
    }
}