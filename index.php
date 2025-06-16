<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
//$routes = include $_SERVER['DOCUMENT_ROOT'].'/crm/routes.php';

//include $_SERVER['DOCUMENT_ROOT'].'/templates/template.php';
//(new \crm\core\Router($routes));

//\core\Application::run();

/**
 * @OneToMany Posts field=category_id
 */
class Category
{

    public int $id;
    public string $title;
    public bool $alias;

}

class Comments
{
    public int $id;
    public string $content;
    public bool $public;
}

/**
 * @OneToMany Comments field=post_id
 */
class Posts
{
    public int $id;
    public string $title;
    public string $alias;
    public int  $comment_id;
    public string  $preview;
    public string  $category_id;

}

$cat_orm = new \core\SimpleORM(Category::class);
$cat_post = new \core\SimpleORM(Posts::class);

$post = $cat_post->find(1);
$cat = $cat_orm->find(1);
foreach ($cat->posts as $k => $val)
{

}
echo '<pre>';

//$cat = json_decode(json_encode($cat),true);
print_r($cat);
print_r($post);
