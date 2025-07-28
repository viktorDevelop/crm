<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
$routes = include 'routes.php';
\core\Application::run($routes);;



//class AES {
//    private const CIPHER = "aes-256-cbc";
//    private const HASH_ALGO = "sha256";
//
//    /**
//     * Шифрует данные с использованием AES-256-CBC
//     * @param string $data Данные для шифрования
//     * @param string $key Ключ (рекомендуется 32 байта для AES-256)
//     * @return string Зашифрованные данные в формате "iv:encrypted_data" (base64)
//     */
//    public static function encrypt(string $data, string $key): string {
//        // Генерируем случайный IV (Initialization Vector)
//        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::CIPHER));
//
//        // Хешируем ключ для гарантии длины 32 байта
//        $keyHashed = hash(self::HASH_ALGO, $key, true);
//
//        // Шифруем данные
//        $encrypted = openssl_encrypt($data, self::CIPHER, $keyHashed, OPENSSL_RAW_DATA, $iv);
//
//        // Объединяем IV и зашифрованные данные в одну строку (base64 для удобства)
//        return base64_encode($iv . $encrypted);
//    }
//
//    /**
//     * Расшифровывает данные, зашифрованные AES-256-CBC
//     * @param string $encryptedData Зашифрованные данные в формате "iv:encrypted_data" (base64)
//     * @param string $key Ключ (должен быть тем же, что и при шифровании)
//     * @return string|false Расшифрованные данные или false при ошибке
//     */
//    public static function decrypt(string $encryptedData, string $key) {
//        // Декодируем из base64
//        $data = base64_decode($encryptedData);
//        if ($data === false) {
//            return false;
//        }
//
//        // Извлекаем IV (первые 16 байт для AES-256-CBC)
//        $ivLength = openssl_cipher_iv_length(self::CIPHER);
//        $iv = substr($data, 0, $ivLength);
//
//        // Извлекаем зашифрованные данные (остаток строки)
//        $encrypted = substr($data, $ivLength);
//
//        // Хешируем ключ
//        $keyHashed = hash(self::HASH_ALGO, $key, true);
//
//        // Расшифровываем
//        return openssl_decrypt($encrypted, self::CIPHER, $keyHashed, OPENSSL_RAW_DATA, $iv);
//    }
//}
//
//// Пример использования
//
//
//
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