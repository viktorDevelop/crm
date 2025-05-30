<?php
namespace services\category;

use core\SimpleORM;

/**
 * Доменный слой (Domain Layer)
 */

class Category extends SimpleORM
{
    public ?int $id = null;
    private string $title;
    private string $alias;


    public function __construct($title = '', $alias = '')
    {
        $this->title = $title;
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): ?int
    {
        return $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

}