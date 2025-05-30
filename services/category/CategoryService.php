<?php
namespace services\category;

use core\Request;
use core\Responce;
use  services\category\Category;

/**
 * Этот слой содержит логику приложения,
 * которая координирует действия между доменным слоем и инфраструктурой.
 * Application Layer
 */
class CategoryService
{
    protected  $page = 1;
    public  $limit = 10;
    protected  $offset = 0;

    private CategoryRepository $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getList()
    {
        if ($this->page)
        {
            $offset = ($this->page - 1) * $this->limit;
            $arResult = $this->categoryRepository->getAll($this->limit,intval($offset));
        }else{
            echo $this->offset;
            $arResult =  $this->categoryRepository->getAll($this->limit,2);
        }

        return $arResult;

    }

    public function add(Request $request)
    {
        $category = new \services\category\Category();
        $category->setTitle($request->data('title'));
        $category->setAlias($request->data('alias'));
        $data = $this->categoryRepository->save($category);
        return Responce::send([
                    'status'=>true,
                    'message'=>[],
                    'data'=> $data
                ]);
    }

    public function update(Request  $request)
    {
        $category = new Category();
        $category->setId($request->data('id'));
        $category->setTitle($request->data('title'));
        $category->setAlias($request->data('alias'));
        $data =  $this->categoryRepository->save($category);
        return Responce::send([
                'status'=>true,
                'data'=> $data
            ]);
    }

    public function delete(Request $request)
    {
        $category = new Category();
        $category->setId($request->data('id'));
        $this->categoryRepository->delete($category);
        return Responce::send([
            'status'=>true,
            'message'=> 'запись удалена '.$request->data('id'),
            'data'=> $category->getId(),
        ]);
    }

    public function deleteAll(Request $request)
    {
        if (is_array($request->data('ids')))
            return ;

        $categoryRepository = new CategoryRepository();
        $service = new CategoryService($categoryRepository);
        $arId = $request->data('ids');
    }
    /**
     * @param mixed $page
     */
    public function setPage($page =''): void
    {
        $this->page = ($page) ? $page : 1;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit = 1): void
    {
         $this->limit = ($limit)?$limit:$this->limit;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = ($offset) ? $offset : $this->offset;
    }

}