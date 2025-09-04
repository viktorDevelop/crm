<?php
namespace core;

use core\interfaces\StateInterface;

class BaseController
{
    protected StateInterface $state;
    protected $isAuth = false;
    public function __construct(StateInterface $state)
    {
        if (Application::$isHiddenPage)
            Autorization::checkAuth();

        $this->state = $state;
    }
}

class Autorization
{
    public static function checkAuth()
    {
        $login = $_SESSION['login'] ?? null;
        $token = $_SESSION['token'] ?? null;
        $permition = $_SESSION['permition'] ?? null;

        if (!$token)
            header('location:/user/autorize');
    }
}