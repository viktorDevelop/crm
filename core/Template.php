<?php
namespace core;

class Template
{
    protected $arComponentTemplate = [];

    private View $view;

    private mixed $tmpName;

    public function __construct($tmpName = '')
    {
        $this->view = View::getInstance();
        $this->tmpName = $tmpName;
    }


    public function show()
    {
        echo $this->view->render($this->tmpName);
    }

    public function setPage($obj)
    {
        $this->view->page_view = $obj;
    }


    public function setComponent($name,$obj)
    {
        $this->view->$name = $obj;
    }
}