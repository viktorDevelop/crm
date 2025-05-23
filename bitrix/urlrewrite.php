<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
//$routes = include_once $_SERVER['DOCUMENT_ROOT'].'/crm/routes.php';
//$router = new  \crm\core\Router($routes);


// /posts/   //controller|model posts actionIndex  method GET
// /posts/:slug //controller|model posts actionShow(slug) method GET
// /posts/create/ //controller|model posts actionCreate method POST
// /posts/edite //controller|model posts actionUpdate method PATCH|PUT
// /posts/delete //controller|model posts actionDelete method DELETE

//public page
//  /php|cat/ список постов категории php | controller|Page actionPosts
//  /php|cat/kak-t|slug|id  детальная поста  | controller|Page actionPosts()

$routes = [
    [
        'condition'=>'#^/users/?([^\\/]+)/?$#',
        'rule'=>'page=$1',
        'controller'=>UserCotroller::class,

    ],

];

$routesResource = [
    'users'=>[
        [
            'condition' =>"#^/api/users/?$#",
            'rule'=>'',
            'controller'=>UserCotroller::class,
        ]
    ]
];

interface PageInterface
{
    public function actionMain();


}

class HomeController implements PageInterface
{

    public function actionMain()
    {
        // TODO: Implement actionMain() method.
    }
}

interface RestInterface
{
    public function actionIndex(Request $request);
    public function actionFind(Request $request);
    public function actionSave(Request $request);
    public function actionDelete(Request $request);
}


class UsersController implements RestInterface
{

    public function actionIndex(Request $request)
    {

        return Responce::send($request->get());
    }

    public function actionFind(Request $request)
    {
        return Responce::send($request->data());
    }

    public function actionSave(Request $request)
    {
        return Responce::send($request->data());
    }

    public function actionDelete(Request $request)
    {
        return Responce::send($request->data());
    }
}

class Request
{
    public function get($name = '')
    {
        if ($name)
            return $_GET[$name];
        return $_GET;
    }

    public function data($name = '')
    {
        $post = file_get_contents('php://input');
        $arPost = ($post) ? json_decode($post,true) : [];
        if (isset($_POST))
            $arPost = array_merge($_POST, $arPost);

        if ($arPost && $name && key_exists($name,$arPost))
            return $arPost[$name];
        else
            return $arPost;
    }
}

class Responce
{
    public static function send($request = [])
    {
        header('Content-Type: application/json');
        http_response_code(200);
        return json_encode($request);
    }
}
class Application
{
    protected $routes = [

        [
            'condition'=>'#^/([a-z]+)/?$#',
            'rule'=>'controller=Home&action=main&section=$1'
        ],

        [
            'condition'=>'#^/([a-z]+)/([a-z]+)/?$#',
            'rule'=>'controller=Home&action=section&section=$1&postCode=$2'
        ],

        [
            'condition'=>'#^/([a-z]+)/([a-z]+)/?$#',
            'rule'=>'controller=Home&action=section&section=$1&postCode=$2'
        ],



        [
            'condition'=>'#^/api/([a-z]+)/([^\\/]+)/?$#',
            'rule'=>'controller=$1',
            'isRest'=>'y'
        ],

        [
            'condition'=>'#^/api/([a-z]+)/?$#',
            'rule'=>'controller=$1',
            'isRest'=>'y'
        ],

    ];
    public static function run()
    {
        $app = new self();
        $uri = $_SERVER['REQUEST_URI'];
        foreach ($app->routes as $k => $items)
        {
            if (preg_match($items['condition'],$uri))
            {
                $rule = preg_replace($items['condition'],$items['rule'],$uri);
                $current_rules = $items;
            }
        }
        $getParams = parse_str($rule,$resArrGetParams);
        if (isset($current_rules['isRest']))
        {
            $app->checkMethod($resArrGetParams['controller'],$resArrGetParams);
        }
    }

    protected function checkMethod($controller,$params = [])
    {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method){
            case 'GET':
                $obj_name =   $controller.'Controller';
                if (class_exists($obj_name))
                {

                    $obj_name = new $obj_name();
                    $action = 'actionIndex';
                    $request = new Request();
                    echo $obj_name->$action($request);
                }else{
                    echo 404;
                }

                break;

            case 'POST':
                $obj_name =   $controller.'Controller';
                if (class_exists($obj_name))
                {

                    $obj_name = new $obj_name();
                    $action = 'actionFind';
                    $request = new Request();
                   echo $obj_name->$action($request);
                }else{
                    echo 404;
                }

                break;

            case 'PATCH':
            case 'PUT':
            $obj_name =   $controller.'Controller';
            if (class_exists($obj_name))
            {
                $obj_name = new $obj_name();
                $action = 'actionSave';
                $request = new Request();
              echo  $obj_name->$action($request);

            }else{
                echo 404;
            }
                break;
            case 'DELETE':
                $obj_name =   $controller.'Controller';
                if (class_exists($obj_name)){
                    $obj_name = new $obj_name();
                    $action = 'actionDelete';
                    $request = new Request();
                   echo $obj_name->$action($request);
                }else{
                    echo 404;
                }
                break;

            default:
                throw new \Exception('Unexpected value');
        }
    }

}


Application::run();


