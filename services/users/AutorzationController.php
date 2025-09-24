<?php
namespace services\users;

use core\Request;

class AutorzationController
{
    /**
     * запрос пользователя по логину или тел и пароль
     *      существует
     *          да - создаем токен, сохраняем в сессию
     *          не - ошибка
     * @return string $token
     * @method POST
     */
    public static function actionAuth(Request $request)
    {
        $autorzationService = new AutorzationService($request);
        return $autorzationService->getAuthToken();

    }

    /**
     * выход
     * @return void
     */
    public function actionSignOut()
    {

    }

    /**
     * вход
     * @return void
     */
    public function actionSignIn()
    {

    }
}