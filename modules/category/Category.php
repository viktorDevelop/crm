<?php
namespace modules\category;

use core\SimpleORM;

class Category extends SimpleORM
{
    public ?int $id;
    public string $alias;
    public string $title;

    public function __construct()
    {
        parent::__construct(self::class);
    }
}