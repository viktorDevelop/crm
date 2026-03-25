<?php
namespace components\Admin\Dashbord\Pages;

use core\DatabaseOrm;
use models\Pages;
use models\Posts;

class PageService
{


    public static function save($model)
    {
        $orm = new DatabaseOrm($model::class);
        return $orm->save($model);
    }

    public static function delete($id)
    {
        $orm = new DatabaseOrm(Pages::class);
        return $orm->delete($id);
    }

    public static function find($id = null)
    {
        $orm = new DatabaseOrm(Pages::class);
        if (!$id)
        {
            return $orm->findAll();
        }else{
            return $orm->find($id);
        }
        return  [];
    }
}