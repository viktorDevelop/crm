<?php
namespace core;

class BaseController
{

    protected  $params;
    protected Request $request;
    private string $state;
    protected mixed $componentState;

    public function __construct($params = [], \core\Request $request)
    {

        $this->params = $params;
        $this->request = $request;
        $this->setState();

        $componentState = $params['components'][$this->state]['componentClass'] ?? null;
        if (!$componentState)
            $this->componentState = View::getInstance();
        if ($componentState)
        {
            if (class_exists($componentState))
            {
                $this->componentState = new $componentState();
            }
        }
//        echo $this->state;
//        echo '<pre>';
//        print_r($componentState);

    }

    public function beforeExecute()
    {

    }

    public function afterExecute()
    {

    }

    private function setState()
    {
        if (empty($this->request->getParams('section_code')))
        {
            $this->state = 'section';
        }
        if (!empty($this->request->getParams('section_code')))
        {
            $this->state = 'list';
        }

        if (!empty($this->request->getParams('element_code')))
        {
            $this->state = 'detail';
        }

    }
}