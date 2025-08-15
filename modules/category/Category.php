<?php
namespace modules\category;

use core\SimpleOrm;

class Category extends SimpleOrm
{
    public ?int $id;
    public string $alias;
    public string $title;
    public int $parent;

    public function __construct()
    {
        parent::__construct(self::class);
    }
}