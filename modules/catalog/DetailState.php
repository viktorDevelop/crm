<?php
namespace modules\catalog;

use core\DatabaseOrm;

class DetailState extends AStatesCatalog
{

    protected function getData(): array | bool
    {
        $post_code = $this->request->getParams('post_code');
        $orm = new DatabaseOrm($this->model);
        $orm->findOne(['post_code'=>$post_code]);
        return  $orm->toArray() ??  [];
    }
}