<?php
namespace crm\Users;

use crm\Irepository\IServise;
use crm\Users\UserEntity;

class UserRepository implements IServise
{

    private UserEntity $entity;

    public function __construct()
    {
        $this->entity = new UserEntity();
    }

    public function find(string $field, $val): array
    {
        return $this->entity->getByField($field,$val);
    }

    public function findAll(string $field, $val): array
    {
        return $this->entity->getByList();
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