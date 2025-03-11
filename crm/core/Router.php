<?php
namespace crm\core;

class Router {

    private $routes = [];
    private $current_rules = [];
    private $request;

    public function __construct($routes = [])
    {
        $this->routes = $routes;
        $this->uri = $_SERVER['REQUEST_URI'];

        $this->getReplaceRules();
        $this->parseUrl();
        $this->get();;
        $this->post();
    }

    public function get()
    {
        if ($_SERVER['REQUEST_METHOD']=='GET'){

            if ($this->current_rules){
                if (in_array('get',$this->current_rules['rest']))
                {
                    header('Content-Type: application/json');
                    http_response_code(200);
                    $this->incController();
                }
                if (in_array('page',$this->current_rules['rest']))
                {
                    $this->incController(false);
                }
            }

        }
    }
    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if ($this->current_rules){

                if (in_array('post',$this->current_rules['rest'])) {
                    header('Content-Type: application/json');
                    http_response_code(200);
                    $this->incController();
                }
            }
        }
    }

    private function incController($json = true)
    {
        $controller = $this->current_rules['controller'];
        $controller_o = new $controller();
        $method = 'action' . ucfirst($this->current_rules['method']);

        if ($json)
            echo json_encode($controller_o->$method($this->request));
        else
            echo $controller_o->$method($this->request);

    }
    public function put()
    {}
    public function delete()
    {}

    private function parseUrl()
    {
        foreach ($this->routes as $k => $items)
        {
            if (preg_match($items['condition'],$this->uri))
            {
                $rule = preg_replace($items['condition'],$items['rule'],$this->uri);
                $this->current_rules = $items;
            }
        }

        $getParams = parse_str($rule,$resArrGetParams);
        $this->request = new Request();
        $this->request->set($resArrGetParams);

    }

    private function getReplaceRules()
    {

        foreach ($this->routes as $key=>$items)
        {
                if (strpos($items['condition'],$k))
                {
//                    $items['condition'] = str_replace($k,$rep,$items['condition']);
                   $this->routes[$key]['condition'] = str_replace($k,$rep,$items['condition']);

                }
        }

    }
}
