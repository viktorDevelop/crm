<?php
namespace core;

abstract class ApiController
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method)
        {
            case 'GET': return $this->find();
            case 'POST': return $this->create();
            case 'PATCH': return $this->update();
            case 'PUT': return $this->update();
            case 'DELETE': return $this->delete();
            default:return $this->notFound();
        }

    }

    abstract protected function find();
    abstract protected function create();
    abstract protected function update();
    abstract protected function delete();

    protected function notFound()
    {
        Responce::send([
           'status'=>false,
            'message'=>'resourse not found'
        ],404,true);
    }

}