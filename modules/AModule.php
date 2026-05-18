<?php
namespace modules;

use core\Request;

abstract class AModule
{
    protected Request $request;
    protected string $model;
    protected string $templateName;
    protected  $listState;
    protected  $detailState;


    public function __construct(Request $request, string $model, string $templateName)
    {
        $this->request = $request;
        $this->model = $model;
        $this->templateName = $templateName;

        $currentStateList =   $this->setCurrentStateListClass();
        $currentStateDetail =   $this->setCurrentStateDetailClass();
        $this->listState = new $currentStateList($request,$model,$templateName);
        $this->detailState = new $currentStateDetail($request,$model,$templateName);
    }

    abstract protected function setCurrentStateListClass():?string;
    abstract protected function setCurrentStateDetailClass():?string;
}