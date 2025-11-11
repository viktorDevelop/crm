<?php
namespace services\Page;

use core\ApiController;
use services\models\Pages;

class PageController extends  ApiController
{

    protected function find()
    {
        $mPage = new Pages();
        $mPage->model->findAll();
        return $mPage->model->toArray();
    }

    protected function create()
    {
        // TODO: Implement create() method.
    }

    protected function update()
    {
        // TODO: Implement update() method.
    }

    protected function delete()
    {
        // TODO: Implement delete() method.
    }
}