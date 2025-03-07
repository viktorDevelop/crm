<?php
namespace crm\Post;

// реализует логику
class PostService
{
    private PostRepository $postRepository;

    /**
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function createPost()
    {

    }
}