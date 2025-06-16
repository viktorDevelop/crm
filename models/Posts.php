<?php
namespace models;

use core\SimpleORM;

class Posts extends SimpleORM
{
    public int $id;
    public string $title;
    public string $asias;
    public string $preview;
}