<?php
namespace crm\Post;

use crm\core\Model;
use crm\Post\Entity\PostEntity;

class PostRepository implements \crm\Irepository\IServise
{
    private PostEntity $postEntity;

    public function __construct(PostEntity $postEntity)
    {

        $this->postEntity = $postEntity;
    }

    public function find(string $field, $val): array
    {
        return [];
    }

    public function findAll($limit = 10,$offset = 0): array
    {
        Model::$limit = $limit;
        Model::$offset = $offset;
        return $this->postEntity->getByList();
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