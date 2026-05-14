<?php
namespace core;

class Template
{
    protected \core\View $view;
    protected $layout;
    protected $templateParams = [];

    public function __construct($layout)
    {
        $this->view = \core\View::getInstance();
        $this->layout = $layout;
    }

    public function setView($var,$view)
    {
        $this->templateParams[$var] =  $view;
    }
    public function setProperty($var,$val)
    {
        $this->templateParams[$var] =  $val;
    }

    public function setContentView($view,$data = [])
    {
        $path = $this->layout.'/'.$view;
        $content = $this->view->render($path,$data);
        $this->templateParams['view_content'] = $content;
    }

    public function show()
    {
        echo $this->view->render($this->layout,$this->templateParams);
    }
}