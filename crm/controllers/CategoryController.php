<?php
namespace crm\controllers;


use crm\controllers\RestInterface;
use crm\core\Request;
use crm\Post\PostRepository;
use crm\Post\PostService;
use crm\controllers\ARestController;


/**
 * CategoryController класс
 * класс для работы с постами
 */

class CategoryController extends ARestController implements RestInterface
{
    // /category/ get all category
    /**
     * получить все посты
     * @return void
     */
    public function actionIndex()
    {
        // TODO: Implement actionIndex() method.
    }

    /**
     * получает одну запись поста по code
     * @param Request $request
     * @return void
     */
    public function actionGetByCode(Request $request)
    {
        // TODO: Implement actionGetByCode() method.
    }

    /**
     * получает одну запись поста по id
     * @param Request $request
     * @return void
     */
    public function actionGetById(Request $request)
    {
        // TODO: Implement actionGetById() method.
    }

    /** сохраняет пост, если нет то добавляет
     * @param Request $request
     * @return void
     */
    public function actionSave(Request $request)
    {
        return $request->post();
    }

    /**
     * удаляет пост
     * @param Request $request
     * @return void
     */
    public function actionDelete(Request $request)
    {
        // TODO: Implement actionDelete() method.
    }


}