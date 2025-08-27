<?php
namespace core;

abstract class BaseComponent
{
    protected View $view;

    protected ?string $template;


    public function __construct($params = [])
    {
        $this->view = View::getInstance();
        $this->template = $params['template'] ?? null;

    }

    public function render()
    {

        return $this->view->render($this->template,['data'=> $this->getData() ]);
    }

    abstract protected function getData();

}