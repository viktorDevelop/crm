<?php
namespace modules\posts;

class Posts
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
