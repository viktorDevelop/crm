<?php
namespace services\category;

use core\Request;
use core\SimpleORM;
use services\category\Category;


/**
 * Инфраструктурный слой (Infrastructure Layer)
* Этот слой реализует репозиторий, например, с использованием базы данных.
 */
class CategoryRepository
{
    protected  $model;
    protected $lastInsertId;
    public function __construct()
    {
        $this->model = new SimpleORM(Category::class);
    }

    /**
     * @param $id
     * @param $fields
     * @return bool
     */
    public function save(Category $category)
    {
        $this->model->save($category);
        if (!$category->getId()){
            $category->setId($this->model->getLastInsertId());
            return $this->lastInsertId = $this->model->getLastInsertId();
        }else{
            $this->model->find($category->getId());
            return $this->model->toArray();
        }
    }

    public function delete(Category $category)
    {

        $this->model->delete($category);
        return $category->getId();
    }


    public function getAll($limit,$offset)
    {
        $this->model->findAll($limit,$offset);
        return $this->model->toArray();
    }

    public function getCount()
    {
        $this->model->findAll();
        $res = $this->model->toArray();
        return count($res);
    }
}