<?php

namespace core;

use models\Params;

class Router
{
    private $routes;
    private Request $request;
    /**
     * @var array|mixed
     */
    private mixed $arParamsPage;
    private enumRouterCatalog $infoState;

    public function __construct()
    {
        $this->createRoutesList();
        $this->parseUrl();
    }

    final protected function parseUrl()
    {
        $uri = $_SERVER['REQUEST_URI'];

        foreach ($this->routes as $k => $route)
        {
            if(preg_match($route['condition'],$uri))
            {
                $current_rule = $route;
                $rule = preg_replace($route['condition'],$route['rule'],$uri);
            }

            if (preg_match($route['condition_rest'],$uri))
            {
                $current_rule = $route;
                $rule = preg_replace($route['condition_rest'],$route['rule'],$uri);
            }
        }


        parse_str($rule,$requestParams);
        $this->request = new Request($requestParams);
        $paramsPage = new DatabaseOrm(Params::class);
        $arParamsPage =  $paramsPage->findAll(['page_id'=>$current_rule['id']])->toArray();
        $this->arParamsPage = $arParamsPage;
        $this->setStateInfo();

    }

    private function prepareParamsConfig()
    {
        $newAr = [];
        foreach ($this->arParamsPage as $k => $value)
        {
            $newAr[$value['name']] = $value;
        }
        return $newAr;
    }

    protected function setStateInfo()
    {
        $enmRouterCatalog = enumRouterCatalog::resolveRouterKey($this->request->getParams());
        $this->infoState =   $enmRouterCatalog;

    }

    public function getAction():?string
    {
        return $this->infoState->getAction($this->prepareParamsConfig());

    }

    public function getTemplate():?string
    {
        return $this->infoState->getTemplate($this->prepareParamsConfig());

    }

    public function getModel():?string
    {
        return $this->infoState->getModel($this->prepareParamsConfig());

    }

    final public function getRequest():Request
    {
        return $this->request;
    }

    final protected function createRoutesList():void
    {
        $orm = new \core\DatabaseOrm(\models\Pages::class);
        $res = $orm->findAll()->toArray();
        $url_rule_params = "(?:/([a-z0-9-]+)?)?(?:/(\?.*)?)?/?";
        $routes = [];
        foreach ($res as $k => $item)
        {
            if ($item['rule'])
            {
                parse_str($item['rule'],$u);
                $slug = implode('?', array_fill(0, count($u), $url_rule_params));
                $routes[$k]['condition'] = "#^/{$item['name']}/?{$slug}/?$#i";
                if ($item['is_rest'])
                {
                    $routes[$k]['condition_rest'] = "#^/api/{$item['name']}/?{$slug}/?(?:/(.*)+)?/?$#i";
                    $routes[$k]['handle'] =  $item['controller'] ?? null;
                }
                $routes[$k]['rule'] = $item['rule'] ?? null;
                $routes[$k]['id'] = $item['id'] ?? null;

            }else{
                $routes[$k]['isStatic'] = true;
                $routes[$k]['rule'] = $item['rule'] ?? null;
                $routes[$k]['condition'] = "#^/{$item['name']}/?{$slug}/?$#i";
                $routes[$k]['content_page'] = $item['content_page'];
            }
        }

        $this->routes = $routes;
    }
}