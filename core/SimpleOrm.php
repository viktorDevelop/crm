<?php
namespace core;


class SimpleOrm
{
    protected \ReflectionClass $reflection;
    private string $table;
    private array $mapping = [];
    private \PDO $pdo;
    /**
     * @var mixed|object|string
     */
    private mixed $toArrayEntity = null;

    /**
     * @throws \ReflectionException
     */
    public function __construct(string $modelClass)
    {
        $this->pdo = Database::getInstance()->getPdoObject();
        $this->reflection = new \ReflectionClass($modelClass);
        $this->table = $this->resolveTableName($modelClass);
        $this->mapping = $this->createPropertyMapping();

    }

    private function createPropertyMapping():array
    {
        $mapping = [];
        $properties = $this->reflection->getProperties();

        foreach ($properties as $property) {
            $column = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $property->getName()));
            $mapping[$property->getName()] = [
                'column' => $column,
                'type' => $this->getPropertyType($property),
                'primary' => false // Можно добавить логику для определения первичного ключа
            ];
        }

        // Определяем первичный ключ (по соглашению 'id' или свойство с аннотацией @Id)
        foreach ($mapping as $name => &$config) {
            if ($name === 'id' || $config['column'] === 'id') {
                $config['primary'] = true;
                break;
            }
        }

        return $mapping;
    }

    private function resolveTableName(string $modelClass):string
    {
        $shortName = $this->reflection->getShortName();
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $shortName));
    }

    private function getPropertyType(\ReflectionProperty $property): string
    {
        if ($property->hasType()) {
            $type = $property->getType();

            if ($type instanceof \ReflectionNamedType) {
                return $type->getName();
            }
        }

        // Анализ PHPDoc для определения типа
        $docComment = $property->getDocComment();
        if ($docComment && preg_match('/@var\s+([^\s]+)/', $docComment, $matches)) {
            return $matches[1];
        }

        return 'string'; // Тип по умолчанию
    }

    /**
     * Получает значение свойства объекта
     */
    private function getPropertyValue(object $entity, string $property)
    {
        $reflectionProperty = $this->reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($entity);
    }

    private function setPropertyValue(object $entity, string $property, $value): void
    {
        $reflectionProperty = $this->reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);

        // Приведение типов
        $type = $this->mapping[$property]['type'] ?? null;
        if ($type) {
            settype($value, $type);
        }

        $reflectionProperty->setValue($entity, $value);
    }

    private function hydrate(array $data): object
    {
        $entity = $this->reflection->newInstanceWithoutConstructor();

        foreach ($this->mapping as $property => $config) {
            $column = $config['column'];


            if (array_key_exists($column, $data)) {
                $value[] = $data[$column];

                $this->setPropertyValue($entity, $property, $value);
            }
        }
        $this->toArrayEntity[] = $data;
        return $entity;
    }

    public function toArray()
    {
        if (count($this->toArrayEntity) == 1)
        {
            return $this->toArrayEntity[0];

        }else{

            return $this->toArrayEntity;
        }
    }


    public function find($id): ?object
    {
        $primaryKey = null;
        foreach ($this->mapping as $config) {
            if ($config['primary']) {
                $primaryKey = $config['column'];
                break;
            }
        }

        if (!$primaryKey) {
            throw new \RuntimeException('Primary key not defined');
        }

        $sql = "SELECT * FROM {$this->table} WHERE {$primaryKey} = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }

        return $this->hydrate($data);
    }



    /**
     * Находит все сущности по критериям
     */
    public function findAllBy(array $criteria = []): array
    {
        $where = [];
        $params = [];
        foreach ($criteria as $field => $value) {
            $where[] = "{$field} = ?";
            $params[] = $value;
        }
        $whereClause = $where ? 'WHERE ' . implode(' AND ', $where) : '';
        $sql = "SELECT * FROM {$this->table} {$whereClause}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $results = [];
        while ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $this->arResult[] = $data;
            $entity = $this->hydrate($data);
            $results[] = $entity;
        }

        return $results;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->query($sql);

        $results = [];
        while ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $results[] = $this->hydrate($data);
        }

        return $results;
    }

    /**
     * Находит сущности по критериям
     */
    public function findBy(array $criteria): ?object
    {
        $where = [];
        $params = [];

        foreach ($criteria as $field => $value) {
            $where[] = "{$field} = ?";
            $params[] = $value;
        }

        $whereClause = implode(' AND ', $where);
        $sql = "SELECT * FROM {$this->table} WHERE {$whereClause} LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $entity = $this->hydrate($data);
//        $this->loadRelations($entity);

        return $entity;
    }

    /**
     * Сохраняет объект в базу данных (вставка или обновление)
     */
    public function save(object $entity): bool
    {
        $primaryKey = null;
        $primaryValue = null;
        $columns = [];
        $values = [];


//        var_dump($columns);

        // Определяем первичный ключ и его значение
        foreach ($this->mapping as $property => $config) {
            if ($config['primary']) {
                $primaryKey = $config['column'];
                $primaryValue = $this->getPropertyValue($entity, $property);
                continue;
            }

            $columns[] = $config['column'];
            $values[] = $this->getPropertyValue($entity, $property);
        }

        if ($primaryValue === null) {
            // Вставка нового объекта
            return $this->insert($entity, $columns, $values);
        } else {

            // Обновление существующего объекта
            return $this->update($entity, $primaryKey, $primaryValue, $columns, $values);
        }
    }

    /**
     * Вставляет новый объект в базу данных
     */
    private function insert(object $entity, array $columns, array $values): bool
    {
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));
        $columnsStr = implode(', ', $columns);

        $sql = "INSERT INTO {$this->table} ({$columnsStr}) VALUES ({$placeholders})";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute($values)) {
            // Устанавливаем ID для нового объекта
            $id = $this->pdo->lastInsertId();
            $this->setPropertyValue($entity, 'id', $id);
            return true;
        }

        return false;
    }

    /**
     * Обновляет существующий объект в базе данных
     */
    private function update(object $entity, string $primaryKey, $primaryValue, array $columns, array $values): bool
    {
        $setParts = [];
        foreach ($columns as $column) {
            $setParts[] = "{$column} = ?";
        }

        $setClause = implode(', ', $setParts);
        echo  $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$primaryKey} = ?";

        // Добавляем первичный ключ в конец значений для WHERE
        $values[] = $primaryValue;

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
        return false;
    }
}