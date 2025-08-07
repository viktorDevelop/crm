<?php
namespace modules\posts;

use core\SimpleORM;

class Posts extends SimpleORM
{
    public ?int $id;
    public string $title;
    public string $content;
    public string $preview;

    public function __construct()
    {
        parent::__construct(self::class);
    }
}
