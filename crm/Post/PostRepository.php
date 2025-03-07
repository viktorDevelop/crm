<?php
namespace crm\Post;

class PostRepository implements \crm\Irepository\IServise
{

    public function find(string $field, $val): array
    {
        return [];
    }

    public function findAll(string $field, $val): array
    {
        return  [];
    }

    public function delete(int $id): void
    {
        // TODO: Implement delete() method.
    }

    public function save(): void
    {
        // TODO: Implement save() method.
    }
}