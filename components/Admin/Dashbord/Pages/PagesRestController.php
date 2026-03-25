<?php
namespace components\Admin\Dashbord\Pages;

use core\Response;
use core\RestBaseController;
use models\Pages;

class PagesRestController extends RestBaseController
{

    public function show()
    {
        $id =  $this->request->get('id');
        $postResult = PageService::find($id);
        Response::send([
            $postResult
        ]);

    }

    public function search()
    {
        echo json_encode([
            'status'=>true,
            'test'=>'search',
            'param'=>$this->request->get(),
            'data'=>[]
        ]);
    }

    public function create()
    {
        try {
            $page = new Pages();
            $page->id = null;
            $page->name = $this->request->getBody('name') ?? throw  new \Exception('field name is reqired');
            $res = PageService::save($page);
            if ($res)
            {
                Response::send($res);
            }
        }catch (\Exception $exception)
        {
            Response::send([],$exception->getMessage(),500);
        }

    }

    public function update()
    {
        try {
            $page = new Pages();
            $page->id = $this->request->getBody('id') ?? throw  new \Exception('field id is reqired');;
            $page->name = $this->request->getBody('name');//->validate(['required'=>true,'type'=>'string']);
            $res = PageService::save($page);
            if ($res)
                Response::send($res);
        }catch (\Exception $exception)
        {
            Response::send([],$exception->getMessage(),500);
        }

    }

    public function delete()
    {
         Response::send([
               'id'=> PageService::delete($this->request->getBody('id'))
         ],'record is deleted');
    }
}