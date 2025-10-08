<?php
namespace services\Page;

use core\CollectionList;
use core\View;
use services\models\Components;
use services\models\Pages;
use services\Posts\PostsService;

class PageService
{
    protected array $pageSettings = [];

    public function execute()
    {
        echo '<pre>';
        print_r($this->pageSettings);
        if ($this->pageSettings['isRest'])
        {

        }

        if (!$this->pageSettings['isRest'])
        {
            //pulic route

            $view = View::getInstance();

            $arComponents_template = [];

            foreach ($this->pageSettings['component_template'] as $k => $val){

            }


            echo $view->render('blog',[
                'page'=>'index',
                'components'=>[
                    'popular.posts'=>$this->popularPost()
                ]
            ]);
        }
    }

    public function popularPost()
    {
        $view = View::getInstance();

        return $view->render('blog/components/popular.posts',[
            'arData'=>PostsService::getPublicPost()
        ]);
    }


    public  function getRoutes()
    {
        $mPage = new Pages();
        $mPage->model->findAll();
        return $mPage->model->toArray();
    }

    public  function getComponentsPage(array $current_rule):void
    {
        $components = new Components();
        $components->model->findAllBy(['page_id='=>$current_rule['id'] ]);
        $components_page = $components->model->toArray();
        $this->pageSettings['components_page'] = $components_page;
    }

    public function getPageSettings(array $current_rule)
    {
        $this->getComponentsPage($current_rule);
        $this->getTemplatesComponents();
        $this->pageSettings['isAuth'] = $current_rule['isAuth'];
        $this->pageSettings['isRest'] = $current_rule['rest'];
        return $this->pageSettings;
    }

    private  function getTemplatesComponents()
    {
        $components = new Components();
        $components->model->findAllBy(['page_id='=>0]);
        $components_page = $components->model->toArray();
        $this->pageSettings['component_template'] = $components_page;

    }


    public static function save()
    {

    }
}