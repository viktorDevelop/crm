<?php
namespace modules\pages;

use core\DatabaseOrm;
use core\interfaces\IRest;
use core\Responce;
use core\Template;
use models\Pages;
use modules\AModule;

class PagesModule extends AModule implements IRest
{

    protected function setCurrentStateListClass(): ?string
    {
        return NotState::class;
    }

    protected function setCurrentStateDetailClass(): ?string
    {
        return NotState::class;
    }

    public function admin()
    {
        $template = new Template('admin');
        $template->setContentView($this->templateName);
        $template->show();
    }

    public function actionShow()
    {
        $orm = new DatabaseOrm($this->model);
        $orm->setLimit(intval($this->request->get('limit',10)));
        $current_page = $this->request->get('page',1);
        $total_count = $orm->findAll()->getCount();
        $offset = ($current_page - 1 ) * $total_count;
        $orm->setOffset($offset);
        $res =  $orm->findAllPaginator();
       Responce::send(200,[
           $res->toArray(),'total_count'=>$total_count,'$offset'=>$offset,'$current_page'=>$current_page,
       ]);
//         Responce::send('200',[
//             'mess'=>'test',
//             'id'=>$this->request->get(),
//             'page'=>$this->request->get('page',1),
//             'limit'=>$this->request->get('limit',50),
//             '$res'=>$res->toArray(),
//             'count'=>$res->getCount()
//
//         ]);
    }

    public function actionCreate()
    {
        $orm = new DatabaseOrm(Pages::class);
        $page = new Pages();
        $page->id = null;
        $page->name = $this->request->getBody('name');
        $page->is_rest = $this->request->getBody('is_rest');
        $page->controller = $this->request->getBody('controller');
        $page->rule = $this->request->getBody('rule');
        $page->content_page = $this->request->getBody('content_page');
        $res = $orm->create($page);
        Responce::send('200',$res);
    }

    public function actionUpdate()
    {
        $orm = new DatabaseOrm(Pages::class);
        $page = new Pages();
        $page->id = $this->request->getBody('id');
        $page->name = $this->request->getBody('name');
        $page->is_rest = $this->request->getBody('is_rest');
        $page->controller = $this->request->getBody('controller');
        $page->rule = $this->request->getBody('rule');
        $page->content_page = $this->request->getBody('content_page');
        $res = $orm->update($page);
        Responce::send('200',$res);
    }

    public function actionDelete()
    {
        $orm = new DatabaseOrm(Pages::class);
        $res = $orm->findOne(['id'=>$this->request->getBody('id')])->getObject();

        try {
            if (!$res->id)  throw new \Exception("не найдена запись с id = ".$this->request->getBody('id'), 1);
            $res = $orm->delete($res);
            Responce::send(200,['id'=>$this->request->getBody('id')],'record deleted');
        }catch (\Throwable $exception)
        {
            Responce::send(400,[],$exception->getMessage());
        }

    }
}