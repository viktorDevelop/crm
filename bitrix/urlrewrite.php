<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

class App
{

    private static $arRoutes = [

//        [
//            'condition' => '#^/api/(category)(?:/([a-z0-9-]+))?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
//            'rule'=>'a=$1'
//        ],

//        [
//            'condition' => '#^/api/(users)(?:/([a-z0-9-]+))/?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i',
//            'rule'=>'b=$1'
//        ],

    ];

    public static function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        foreach (self::$arRoutes as  $k => $item)
        {

            if ( preg_match($item['condition'],$uri) )
            {

                $current = $item;
                $rule = preg_replace($item['condition'],$item['rule'],$uri);
            }
        }

        parse_str($rule,$arGetSlug);
        $request = new \core\Request($arGetSlug);
        print_r($current);
        if (!$current)
            echo 'bad way, 404';
            return '';
        switch ($method)
        {
            case 'GET':break;
            case 'POST': echo 'test'; break;

        }
    }

    public static function addRouterAPI($path,$rule,$className)
    {
        $preg = "(?:/([a-z0-9-]+))?(?:/([a-z0-9-]+))?(?:/(\?.*)?)?$#i";

        $ar['condition'] = '#^/api/('.$path.')'.$preg;
        $ar['rule'] = $rule;
        $ar['className'] = $className;
         array_push(self::$arRoutes,$ar);
    }

}

class UserController
{

     public function actionView()
     {

     }
    public function actionSearch()
    {
        $user = new \services\users\Users();
        $user->model->findAll();
        $res = $user->model->toArray();

        return json_encode([
            'status'=>true,
            'data'=>$res
        ]);
    }

    public function actionAdd(\core\Request $request)
    {

    }
}

App::addRouterAPI('users','user_id=$1&collection=$2',UserController::class);
App::run();