<?php
namespace crm\Post;

use crm\core\Model;
use crm\Post\Entity\PostEntity;

class PostRepository implements \crm\Irepository\IServise
{
    private PostEntity $postEntity;

    public function __construct()
    {
        $this->postEntity = new PostEntity();
    }

    public function find(string $field, $val): array
    {
        return [];
    }

    public function findAll($limit = 10,$offset = 0): array
    {
        Model::$limit = $limit;
        Model::$offset = $offset;
        return [
            'posts'=>$this->postEntity->getByList(),
            'postCount'=>$this->postEntity->getCount()['count']
        ];
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