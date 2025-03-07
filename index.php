<?php
//include $_SERVER['DOCUMENT_ROOT'].'/templates/template.php';
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
?>

<?php

use crm\Post\Entity\PostEntity as Post;


$post = new Post();
//
//$res = $post->getByList();

$post = new \crm\Post\PostRepository($post);

$res = $post->findAll(1,1);

echo '<pre>';
print_r($res);



