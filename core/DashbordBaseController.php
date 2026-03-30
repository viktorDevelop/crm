<?php
namespace core;

class DashbordBaseController
{
    private $controller;
    /**
     * @var mixed|string
     */
    protected mixed $action;
    protected Request $request;

    /**
     * @var mixed|null
     */


    public function __construct($controller = null,$params = [])
    {
        $this->action = $params['action'] ?? 'show';
        $this->action = 'action'.$this->action;
        $this->request = new Request($params);
        $this->controller = $controller;
    }

    public function execute()
    {

        if (class_exists($this->controller))
        {
            $handle = new $this->controller();
            if (method_exists($handle,$this->action))
                $handle->{$this->action}();
        }
    }


}