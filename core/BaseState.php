<?php
namespace core;

abstract class BaseState
{
    private $tmpState;

    public function __construct($tmpState = '')
    {
        $this->tmpState = $tmpState;
        $this->view = View::getInstance();
        $this->tmpState = $tmpState;
    }

    public function execute()
    {
      return  $this->render('blog');
    }

    public function render($tmp)
    {
        $view = View::getInstance();

        return $view->render($tmp,[
            'page'=> $view->render($this->tmpState,$this->getDate())
        ]);
    }
    abstract protected function getDate();

}