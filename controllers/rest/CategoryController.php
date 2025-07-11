<?php
namespace controllers\rest;
use core\interfaces\RestInterface;
use core\Request;
use core\Responce;
use core\SimpleORM;
use models\Category;
use services\category\CategoryRepository;
use services\category\CategoryService;

class CategoryController implements RestInterface
{
    public function actionIndex(Request  $request)
    {
        $categoryRepository = new CategoryRepository();
        $service = new CategoryService($categoryRepository);
        $service->setPage(intval($request->get('page')));
        $service->setLimit(intval($request->get('limit')));
        $service->setOffset(intval($request->get('offset')));

        $result = $service->getList();
        $reponse['status'] = true;
        $reponse['result'] = $request->get('page');
        $reponse['count'] = count($result);
        $reponse['data'] = $result;
        return Responce::send($reponse);
    }

    /**
     * @param \core\Request|Request $request
     * @return false|string
     */
    public function actionFind(Request $request)
    {
        $model = new SimpleORM('models\Category');
        $category = new Category(
            $request->data('title'),
            $request->data('alias')
        );
        $data = [];
        return Responce::send([
            'status'=>true,
            'data'=> $data
        ]);
    }

    public function actionSave(Request  $request)
    {
        $categoryRepository = new CategoryRepository();
        $service = new CategoryService($categoryRepository);
        if ($request->getMethod() == 'POST')
        {
           $responseData = $service->add($request);
        }
        if ($request->getMethod()=="PATCH")
        {
            $responseData =  $service->update($request);
        }
        return $responseData;
    }

    public function actionDelete(Request $request)
    {
        $categoryRepository = new CategoryRepository();
        $service = new CategoryService($categoryRepository);
        return $service->delete($request);
    }

}