<?php
//include $_SERVER['DOCUMENT_ROOT'].'/templates/template.php';
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
?>

<?php

use crm\Post\Entity\PostEntity as Post;


$post = new Post();

$res = $post->getByList();

echo '<pre>';
var_dump($res);




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

