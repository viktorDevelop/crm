<?php
namespace services\posts;

use core\SimpleOrm;

/**
 * @property SimpleOrm $model
 */
class Posts
{
    public ?int $id;
    public string $title;
    public string $content;
    public int $user_id;
    public string $description;
    public bool $popular;
    public int $likes;

    public function __construct()
    {
        $this->model = new SimpleOrm(self::class);
    }
}
