<?php
namespace controllers\rest;

use core\interfaces\Request;
use core\interfaces\RestInterface;
use core\Responce;
use core\SimpleORM;
use models\Category;

class CategoryController implements RestInterface
{


    public function actionIndex(\core\Request|\core\interfaces\Request $request)
    {
        $arResult = [];
        $model = new SimpleORM('models\Category');
        $limit = 100;
        $offset = 0;
        $page = $request->get('page');
        if ($page){
            $limit = 2;
            $count = $this->getCount();
            $offset = ($page - 1) * $limit;
        }
        $res = (array) $model->findAll($limit,$offset);
        $arResult = ($res) ?: $model->toArray();
        return Responce::send($arResult);
    }

    public function getCount()
    {
        $model = new SimpleORM('models\Category');
        $model->findAll();
        return count($model->toArray());
    }

    public function actionFind(\core\Request|\core\interfaces\Request $request)
    {
        $model = new SimpleORM('models\Category');
        $res = (array) $model->find($request->data('id'));
        $result = $model->toArray();
        return Responce::send($result);
    }

    public function actionSave(\core\Request|\core\interfaces\Request $request)
    {
        $model = new SimpleORM('models\Category');

        if ($request->data('id'))
        {
            echo $request->data('id');
            $model->find($request->data('id'));
            $category = new Category();
            $category->setTitle($request->data('title'));
            $category->setAlias($request->data('alias'));
        }else{
             $category = new Category(
                $request->data('title'),
                $request->data('alias')
            );
        }
       $res =  $model->save($category);
        return Responce::send($res);

    }

    public function actionDelete(\core\Request|\core\interfaces\Request $request)
    {
        // TODO: Implement actionDelete() method.
    }
}