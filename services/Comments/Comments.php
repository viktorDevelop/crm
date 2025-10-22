<?php
namespace services\Comments;

use core\SimpleOrm;

/**
 * @property SimpleOrm $model
 */
class Comments
{
    public ?int $id;
    public int $user_id;
    public int $post_id;
    public string $comment_text;

    public function __construct()
    {
        $this->model = new SimpleOrm(self::class);
    }

    public function save()
    {
        $orm = new SimpleOrm(self::class);
        $orm->save($this);
    }

}