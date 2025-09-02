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
        $login = $_SESSION['login'] ?? null;
        $token = $_SESSION['token'] ?? null;

        $arPolitic = $this->params['autorization'] ?? false;
        if (is_array($arPolitic))
        {
            $this->checkSuccess($arPolitic);
        }

//       var_dump($arPolitic );
//       var_dump($a);
    }



    private  function checkSuccess($arPolitic)
    {
        if (!is_array($arPolitic))
            return  false;

        $login = $_SESSION['login'] ?? null;
        $token = $_SESSION['token'] ?? null;

        if (!$login) return  false;
        if (!$token) return  false;

        $token = unserialize($token);

        $success = false;
        foreach ($arPolitic['role'] as $k=>$value)
        {
            if (in_array($value,$token['role']))
            {
                $success = true;
                break;
            }
        }
//        var_dump($success);
//        var_dump($token);
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