<?php
namespace services\user;

use core\BaseController;
use core\interfaces\RestService;
use core\Request;
use core\Responce;

class controller extends BaseController implements RestService
{
    public function actionShowPage(Request $request)
    {
        return  $this->state->execute();
    }

    public function actionFind(Request $request)
    {

    }

    public function actionStore(Request $request)
    {
        // TODO: Implement actionStore() method.
    }

    public function actionUpdate(Request $request)
    {
        // TODO: Implement actionUpdate() method.
    }

    public function actionDelete(Request $request)
    {
        // TODO: Implement actionDelete() method.
    }
}
