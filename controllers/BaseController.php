<?php
namespace controllers;
use core\PageConfigHelper;
use core\Request;
use modules\posts\components\PostList;
use modules\posts\Posts;

abstract class BaseController
{
    protected PageConfigHelper $configPage;
    public function __construct(PageConfigHelper $configPage)
    {
        $this->configPage = $configPage;
    }


    public function template()
    {
        /** @var  $view \core\View */
        $view = \core\View::getInstance();
        $arComponents = [];

        foreach ($this->configPage->components as $k => $val)
        {
            $name =  explode('\\',  $val['className']);
            $sName = end($name);
            $sName .='Data';
            $arComponents = [
                [ $sName =>$val['className']::getData($val['params'],$this->configPage->request),'views'=>$val['template']  ]
            ];
        }
        echo $view->render('blog',[
            "CategoryMenuTopData"=>[],
            'components' =>  $arComponents
        ]);
    }

    abstract public function  execute();
}