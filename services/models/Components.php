<?php
namespace services\models;

use core\SimpleOrm;

/**
 * @property SimpleOrm $model
 */
class Components
{
    protected ?int $id;
    protected string $title;
    protected string $object;
    protected int $page_id;
    protected string $params;
    protected string $template;

    public function __construct()
    {
        $this->model = new SimpleOrm(self::class);
    }
}