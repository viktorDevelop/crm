<?php
namespace modules\admin\pages;


use core\SimpleOrm;

class Pages
{
    public ?int $id;
    public string $title;
    public string $preview;
    public string $keyword;
    public string $description;
    public string $cond;
    public string $rule;
    public string $environment;
    public int $components_id;

    public function getModel():SimpleOrm
    {
        return  new SimpleOrm(self::class);
    }
}