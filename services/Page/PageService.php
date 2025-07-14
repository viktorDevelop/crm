<?php
namespace services\Page;

use core\CollectionList;
use core\Request;
use core\Template;
use core\View;
use services\models\Components;
use services\models\Pages;
use services\Posts\PostsService;

class PageService
{
    protected array $pageSettings = [];
    protected ?string $page = '404';

    public function execute($request)
    {
//        echo '<pre>'; print_r($this->pageSettings);

        if (!$this->pageSettings['isRest'])
        {

            $tmp = new Template('blog');
            foreach ($this->pageSettings['component_template'] as $k => $val)
            {
                if (!empty($val['name'])) {
                    $tmp->setComponent($val['name'],(new $val['object'])->execute($val['params']));
                }
            }

            $content = $this->pageSettings['components_page'][0]['object'] ?? null;
            if ($content){

                $oContent = new $content();
                $params = $this->pageSettings['components_page'][0]['params'];
                $tmp->setPage(($oContent)->execute($params,$request));
            }

            $tmp->show();
        }
    }

    public function ApiExecute(?array $params,Request $request)
    {
        $controller = $params['handle'] ?? null;
        if ($controller)
        {
            $sController = '\\services\\'.ucfirst($controller).'\\'.ucfirst($controller).'Controller';
            $oController = new $sController($request);
        }
    }

    public static function getPageList()
    {
        return [];
    }



    public  function getRoutes()
    {
        $mPage = new Pages();
        $mPage->model->findAll();
        return $mPage->model->toArray();
    }

    public  function getComponentsPage(?array $current_rule):void
    {
        $components = new Components();
        $components->model->findAllBy(['page_id='=>$current_rule['id'] ]);
        $components_page = $components->model->toArray();
        $this->pageSettings['components_page'] = $components_page;
    }

    public function getPageSettings(?array $current_rule,$page = null)
    {
        $this->page = $page;
        $this->getComponentsPage($current_rule);
        $this->getTemplatesComponents();
        $this->pageSettings['isAuth'] = $current_rule['isAuth'];
        $this->pageSettings['isRest'] = $current_rule['rest'];
        return $this->pageSettings;
    }

    public  function getTemplatesComponents()
    {
        $components = new Components();
        $components->model->findAllBy(['page_id='=>0]);
        $components_page = $components->model->toArray();
        $this->pageSettings['component_template'] = $components_page;
        return $components_page;
    }


    public static function save()
    {

    }
}