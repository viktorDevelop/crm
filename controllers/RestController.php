<?php
namespace controllers;

use core\interfaces\Resource;
use core\Request;
use core\Responce;

class RestController implements Resource
{

    public function find(Request $request)
    {
        $name = $request->getParams('handle');
         $sName = '\\modules\\'.$name.'\\'.ucfirst($name).'Service';
         if (!class_exists($sName))
         {
             return Responce::send([
                 'status'=>false,
                 'message'=>'not found data'
             ],404);
         }
         $oHandle = new $sName($request);

      return  Responce::send([
            'data'=>$oHandle->getData()
        ]);
    }

    public function update(Request $request)
    {
        // TODO: Implement update() method.
    }

    public function create(Request $request)
    {
        // TODO: Implement create() method.
    }

    public function delete(Request $request)
    {
        // TODO: Implement delete() method.
    }
}