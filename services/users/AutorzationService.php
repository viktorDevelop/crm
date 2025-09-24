<?php
namespace services\users;

use core\Responce;

/**
 * Здесь логика
 */
class AutorzationService
{


    public function __construct()
    {
    }


    public function getAuthToken()
    {

    }

    public function setSession()
    {

    }

    public function getSession()
    {

    }

    public function unsetSession()
    {
        unset($_SESSION['AUTH_USER']);
    }

}