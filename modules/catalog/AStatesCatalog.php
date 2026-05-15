<?php
namespace modules\catalog;

use core\Request;
use core\Template;

abstract class AStatesCatalog
{
    protected Template $template;
    protected mixed $category_code;
    protected $model;
    protected $templateName;
    protected Request $request;

    protected  $title = '';

    public function __construct(Request $request, $model, $templateName)
    {
        $this->template = new Template('blog');
        $this->category_code = $request->getParams('category_codе');
        $this->model = $model;
        $this->templateName = $templateName;
        $this->request = $request;
    }

    abstract protected function getData():array | bool;

     public function  render()
     {
         $this->template->setContentView($this->templateName,['arResult'=>$this->getData()]);
         $this->template->setProperty('title',$this->title);
         $this->template->show();
     }
}