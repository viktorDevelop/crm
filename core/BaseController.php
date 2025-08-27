<?php
namespace core;

class BaseController
{

    protected  $params;
    protected Request $request;
    private string $state;
    protected mixed $componentState;

    protected mixed $typePage;

    public function __construct($params = [], \core\Request $request)
    {

        $this->params = $params;
        $this->request = $request;
        $this->setState();
        $this->typePage = $params['type'] ?? null;
        $componentState = $params['components'][$this->state]['componentClass'] ?? null;
        if (!$componentState)
            $this->componentState = View::getInstance();
        if ($componentState)
        {
            if (class_exists($componentState))
            {
                $this->componentState = new $componentState($params['components'][$this->state]);
            }
        }
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