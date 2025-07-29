<?php
namespace components\autorizate\form;

use core\Helpers\AES;
use core\View;
use models\Users;


class Autorizate
{

    public function render()
    {
        /** @var $view View */
        $view = View::getInstance();
        return $view->render('components/Autorizate/form');
    }

    public static function checkUserRole()
    {
        $user_id = $_SESSION['USER_ID'] ;
        if (!$user_id)
            return false;
        $oUser = new \models\Users();
        $oUser->find($user_id);
        $arUser = $oUser->toArray();

        if (!$arUser)
            return false;

        //private key
        $password = $arUser['password'];
        $decryptData =  \core\Helpers\AES::decrypt($_SESSION['token'],$password);
        $decryptData = json_decode($decryptData,true);
        //var_dump($decryptData);
        $date_expired = $decryptData['date_expired'];
        $date_expired = new \DateTime($date_expired);
        $currentDate = new \DateTime();

        if ($date_expired < $currentDate)
        {
            return 'время жизни токена истекло, авторизуйтесь';

        }

        return  true;
    }

    public function authorize($login,$password)
    {
        $password = md5(sha1($password));;
        $user = new Users();
        $user->findBy(['login'=>$login,'password'=>$password]);
        $res = $user->toArray();

        if (empty($res))
            return 'не верный логин или пароль';

        $res = $res[0];
        $token_data = [
            "login"=> $res['login'],
            "role"=>$res['role'],
            'data_created'=>(new \DateTime('now'))->format('Y-m-d h:i'),
            'date_expired'=>(new \DateTime('now'))->modify('+12 hour')->format('Y-m-d h:i')
        ];

        $token_data = json_encode($token_data);
        $token = AES::encrypt($token_data,$password);

        $_SESSION['USER_ID'] = $res['id'];
        $_SESSION['token'] = $token;
         return $token;
    }



    public static function unAuth()
    {
        unset($_SESSION['USER_ID']);
        unset($_SESSION['token']);
    }


}