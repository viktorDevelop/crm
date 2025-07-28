<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
$routes = include 'routes.php';
\core\Application::run($routes);;



//class AES {


////$key =  md5(sha1('123'));
////$data = json_encode(['id'=>1,'role'=>'admin']);
////
////// Шифруем
////$encrypted = AES::encrypt($data, $key);
////echo "Зашифровано: " . $encrypted . "\n";
////
////// Расшифровываем
////$decrypted = AES::decrypt($encrypted, $key);
////echo "Расшифровано: " . $decrypted . "\n";
//
//class Authorization
//{
//    public function setSesstion()
//    {
//        $_SESSION['AUTH'] = 'abr2323';
//    }
//
//    public function getSession()
//    {
//        return (isset($_SESSION['AUTH'])) ? $_SESSION['AUTH'] : false;
//    }
//
//    /**
//     * @return array
//     * проверка user in bd
//     */
//    public function getUserById($id)
//    {
//        $user = new \models\Users();
//        $user->find($id);
//        return $user->toArray();
//    }
//
//    public function getUser($login,$password)
//    {
//        $user = new \models\Users();
//        $user->findBy(['login'=>$login,'password'=>$password]);
//        return $user;
//    }
//}
//
//
//$auth = new Authorization();
//$res = $auth->getUser('viktor','123')->toArray();
//
//
//
//echo '<pre>';
//print_r($res);