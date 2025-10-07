<?php
namespace services\models;

use core\SimpleOrm;

/**
 * @property SimpleOrm $model
 */
class Pages
{
    protected ?int $id;
    protected string $title;
    protected string $rule;
    protected string $condition;
    protected bool $isAuth;

    public function __construct()
    {
        $this->model = new SimpleOrm(self::class);
    }
}