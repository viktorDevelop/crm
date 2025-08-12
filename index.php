<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

class Application
{
    public static function run()
    {

    }
}

class Routes
{
    public function get()
    {

    }
}

$page = new \modules\admin\pages\Pages();

$orm = new \core\SimpleOrm($page::class);

$res = $orm->find(1);

echo '<pre>';
$r = json_decode(json_encode($res,true),true);
print_r($r);
