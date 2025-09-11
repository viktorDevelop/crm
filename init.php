<?php
session_start();
spl_autoload_register(function ($class){
    $path = $_SERVER['DOCUMENT_ROOT'].'/'.str_replace('\\','/',$class);
    $path .= '.php';
    if (file_exists($path)){
        include $path;
    }

});


class Application
{
    private static $arRoutes = [];

    public static function addRoute($pattern, $handleClass,$rule = '')
    {
        self::$arRoutes[$pattern] = [
            'handleClass'=>$handleClass,
            'rule'=>$rule
        ];
    }

    public static function init()
    {

    }

    public static function run()
    {
        $currentRule = self::dispatche();
        $uri = $_SERVER['REQUEST_URI'];

        $curentApi = $currentRule['current_path']['api'] ?? null;
        $currentPage = $currentRule['current_path']['isPage'] ?? null;

        echo '<per>'; print_r($currentRule);
        if ($currentPage)
        {

            $pattern = $currentRule['current_path']['current_rule']['page_path'] ?? null;
            if ($pattern)
            {
                $rule =  preg_replace($pattern,$currentRule['current_path']['current_rule']['rule'],$uri);
            }
            parse_str($rule,$resultGetParams);

            $request = new \core\Request($resultGetParams);
            print_r($rule);
        }
    }
    public static function dispatche()
    {

        $uri = $_SERVER['REQUEST_URI'];
//        echo '<pre>';
//        print_r(self::$arRoutes);
        foreach (self::$arRoutes as $k=>$val)
        {
            $pattern = str_replace(':str','?(?:/([a-z]+))',$k);
            $pattern = str_replace(':any','?(?:/([a-z0-9-]+))',$pattern);
            $pattern = str_replace(':int','?(?:/([0-9-]+)',$pattern);
            $pattern = str_replace(':get','?(?:/(\?.*)?)',$pattern);
            $sPattern = $pattern;
            $pattern = '#^'.$sPattern.'/?$#i' ;
            $pattern_api = '#^/api'.$sPattern.'/?$#i';

            self::$arRoutes[$k] = [
              'handle'=>$val['handleClass'],
              'page_path'=>$pattern,
              'pattern_api'=>$pattern_api,
              'rule'=>$val['rule']
            ];
        }

        foreach (self::$arRoutes as $k=>$item)
            {
                if (preg_match($item['page_path'],$uri))
                {
                    $current['current_path'] = [
                        'current_rule'=>$item,
                        'isPage'=>true
                    ];

                }

                if (preg_match($item['pattern_api'],$uri))
                {
                    $current['current_path'] = [
                        'current_rule'=>$item,
                        'api'=>true
                    ];
                }
            }



        return $current;

    }
}


Application::addRoute('/portfolio/:str',Category::class);

Application::addRoute('/api/portfolio/:str/comments',
    Portfolio::class,
    'prorfolio_element_code=$1');

Application::addRoute('/portfolio/:str/comments',
    CategoryViewer::class,
    'prorfolio_element_code=$1');

Application::addRoute('/blog/:str/:any',Category::class);

Application::run();

abstract class BaseController
{
    public function __construct($arComponents = [])
    {
        $arComponents = [
            [
                'section'=>[
                    [
                        'slider'=>'template/blog/slider/posts',
                        'componentClass'=>SliderContent::class
                    ],
                    [
                        'category'=>'template/blog/category/blocks',
                        'componentClass'=>Category::class
                    ]
                ],
                'list'=>[
                    [
                        'slider'=>'template/blog/slider/picture',
                        'componentClass'=>SliderImage::class
                    ],
                    [
                        'posts'=>'template/blog/posts/blocks',
                        'componentClass'=>Posts::class
                    ],
                ],
                'item'=>[
                   [
                       'postItem'=>'template/blog/post/simple'
                   ],
                    [
                        'comments' => 'template/blog/comments',
                        'componentClass'=>Comments::class
                    ],
                    [
                        'tabs' => 'template/blog/tabs',
                        'componentClass'=>TabsContent::class
                    ],

                ],
            ]
        ];
    }
}

class CategoryViewer extends BaseController
{

}

class PortfolioController
{
    public function show()
    {

    }

    public function showItem()
    {

    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

}