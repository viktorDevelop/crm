<?php
//include $_SERVER['DOCUMENT_ROOT'].'/templates/template.php';
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
?>

<?php

use crm\Post\Entity\PostEntity as Post;


$post = new Post();
$post->title = 'title';
$post->id = 'id';
 $post->id;
//echo $post->id;
//echo $post->category_id;
echo $post->title;
//echo $post->aaa;


var_dump($post::getError());
interface IServise
{
    public function find(string $field,$val):array;
    public function findAll(string $field,$val):array;
    public function delete(int $id):void;
    public function save():void;
}
class PostService
{

}


