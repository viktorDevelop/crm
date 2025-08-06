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

         $oHandle = new $sName($request);
        $componentData = '';
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