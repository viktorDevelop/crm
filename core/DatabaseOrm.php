<?php
namespace core;

class DatabaseOrm
{
    private \ReflectionClass $reflection;
    private array $fields;
    private \PDO $pdo;
    private string $table;
    private mixed $result = [];

    protected int $limit = 100;
    protected int $offset = 0;

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
    public function findAll(array $condition = []):self
    {
        $fields = implode(',',$this->fields);
        $where = [];
        $params = [];
        foreach ($condition as $field => $value) {
            $where[] = "{$field} = ?";
            $params[] = $value;

        }
        $whereClause = $where ? 'WHERE ' . implode(' AND ', $where) : '';
        $sql = "SELECT {$fields}  FROM {$this->table} {$whereClause} ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $this->result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this;
    }

    public function findAllPaginator(array $condition = []):self
    {
        $fields = implode(',',$this->fields);
        $where = [];

        $values = [];
        foreach ($condition as $field => $value) {
            $values[':'.$field] = $value;
            $fielsPlaceholder[] = $field."=:".$field;
        }

        $whereClause = $fielsPlaceholder ? 'WHERE ' . implode(' AND ', $fielsPlaceholder) : '';
        $sql = "SELECT {$fields}  FROM {$this->table} {$whereClause} LIMIT :limit OFFSET :offset ";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':limit',$this->limit,\PDO::PARAM_INT);
        $stmt->bindParam(':offset',$this->offset,\PDO::PARAM_INT);

        foreach ($values as $key => &$value) {
            $stmt->bindParam($key, $value);
        }

        $stmt->execute();
        $this->result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this;
    }

    public function getCount()
    {
        return count($this->result);
    }

    public function getResult()
    {
        return $this->result;
    }
    public function getObject()
    {
        $entity = $this->reflection->newInstanceWithoutConstructor();
        if (!$this->result) return  false;
        foreach ($this->result as $k => $value)
        {
            $entity->$k = $value;
        }
        return $entity;

    }

    public function toArray()
    {
        return $this->result;
    }

    public function create($model)
    {
        $values = [];
        $arFields = $this->fields;
           foreach ($arFields as $k=>$val)
           {
               if ($val == 'id' && empty($model->id)) unset($arFields[$k]);
               if ($val != 'id')
               {
                   $values[] = $model->$val ?? null;
               }

           }
        $fields = implode(',',$arFields);

        $placeHolder  = implode(', ', array_fill(0, count($values), '?'));
        $sql = "INSERT  INTO {$this->table} ({$fields})   VALUES ({$placeHolder})";
        $stm = $this->pdo->prepare($sql);
        $stm->execute($values);
        $id = $this->pdo->lastInsertId();
        return $this->findOne(['id'=>$id])->toArray();

    }

    public function update($model)
    {
        if (!$model->id) return false;
        $values = [];
        $arFields = $this->fields;
        foreach ($arFields as $k=>$val)
        {
            $values[':'.$val] = $model->$val ?? null;
            $fielsPlaceholder[] = $val."=:".$val;
        }

        $fields = implode(',',$fielsPlaceholder);
        $sql = "UPDATE pages SET  {$fields} WHERE id = :id";
        $stm = $this->pdo->prepare($sql);
        $stm->execute($values);
        return $this->findOne(['id'=>$model->id])->toArray() ?? [];

    }

    public function delete($model)
    {
        if (!$model->id) return false;

        $stm = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stm->execute([':id'=>$model->id]);
        return true;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }


}