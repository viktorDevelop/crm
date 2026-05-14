<?php
namespace models;

class Posts
{
    public int $id;
    public int $category_id;
    public string $title;
    public string $keyword;
    public string $description;
    public string $full_text;
    public string $preview_text;
    public string $post_code;
}