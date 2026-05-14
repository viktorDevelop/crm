<?php
namespace core;

class DatabaseOrm
{
    private \ReflectionClass $reflection;
    private array $fields;
    private \PDO $pdo;
    private string $table;
    private mixed $result = [];

    public function __construct(string $class)
    {
        $this->reflection = new \ReflectionClass($class);
        $this->pdo = Database::getInstance()->getPdoObject();
        $this->getProperties();
        $this->getTableName();
    }

    protected function getTableName()
    {
        $this->table = lcfirst($this->reflection->getShortName());
    }

    protected function getProperties():void
    {

        $arProps = [];
        foreach ($this->reflection->getProperties() as $prop)
        {
            $arProps[] = $prop->name;
        }
       $this->fields = $arProps;
    }

    public function findOne(array $condition = [])
    {
        $fields = implode(',',$this->fields);
        $where = [];
        $params = [];
        foreach ($condition as $field => $value) {
            $where[] = "{$field} = ?";
            $params[] = $value;
        }

        $whereClause = implode(' AND ', $where);
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$whereClause} LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $this->result =  $stmt->fetch(\PDO::FETCH_ASSOC);
        return $this;
    }
    public function findAll(array $condition = [])
    {
        $fields = implode(',',$this->fields);
        $where = [];
        $params = [];
        foreach ($condition as $field => $value) {
            $where[] = "{$field} = ?";
            $params[] = $value;
        }

        $whereClause = $where ? 'WHERE ' . implode(' AND ', $where) : '';
        $sql = "SELECT {$fields} FROM {$this->table} {$whereClause}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $results = [];
        while ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $this->result[] = $data;
        }
        return $this;
    }

    public function toArray()
    {
        return $this->result;
    }

}