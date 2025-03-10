<?php
namespace crm\Post;

// реализует логику
class PostService
{
    private PostRepository $postRepository;

    protected string $categorySlug;
    protected int $categoryId;
    private $limit = 10;
    private $currentPage = 1;

    /**
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    //логика получения постов
    public function setCategoryPost($category)
    {
        if (is_int($category))
            $this->categoryId = $category;

        if (is_string($category))
            $this->categorySlug = $category;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    public function setPage($page)
    {
        $this->currentPage = $page;
    }
    public function pagination()
    {
        $limit = $this->limit;
        $posts =  $this->postRepository->findAll();
        $postsCount = $posts['count'];
        $page = max(1,(int) $this->currentPage);
        $offset = ($page - 1) * (int)$limit;
        $totalPages = ceil($postsCount/$limit);
        return  $this->postRepository->findAll($limit,$offset);
    }


    public function getPosts()
    {
       return $this->pagination();
    }
}