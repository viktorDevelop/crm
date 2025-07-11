<?php
namespace core;
use \ReflectionClass;
use \PDO;
class SimpleORM
{
    private \PDO $pdo;
    private string $table;
    private ReflectionClass $reflection;
    private array $mapping = [];
    private array $arResult = [];
    private int $lastInsertId;
    protected $relation;

    public function __construct(string $modelClass)
    {
//        $arConfig = [];
//        $arConfig['host'] = 'db';
//        $arConfig['user'] = 'bitrix';
//        $arConfig['db_name'] = 'bitrix';
//        $arConfig['password'] = '123';
//        $this->pdo = new \PDO('mysql:dbname='.$arConfig['db_name'].';host='.$arConfig['host'],$arConfig['user'],$arConfig['password']);
        $this->pdo = Database::getInstance()->getConnect();
        $this->reflection = new \ReflectionClass($modelClass);

        // Автоматическое определение имени таблицы
        $this->table = $this->resolveTableName($modelClass);

        // Создание маппинга свойств класса на колонки таблицы
        $this->mapping = $this->createPropertyMapping();
        $this->relation = $this->detectedRelation();

//        echo "<pre>"; print_r($this->relation);
    }

    private function detectedRelation()
    {
        $relations = [];
        $docComment = $this->reflection->getDocComment();

        if (!$docComment) {
            return $relations;
        }

        // Поиск аннотаций @OneToMany, @ManyToOne, @ManyToMany
        if (preg_match_all('/@(OneToMany|ManyToOne|ManyToMany)\s+([^\s]+)\s*(.*)/', $docComment, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $relationType = $match[1];
                $targetClass = $match[2];

                $options = $this->parseRelationOptions($match[3] ?? '');

                $relations[] = [
                    'type' => $relationType,
                    'target' => $targetClass,
                    'options' => $options
                ];
            }
        }

        return $relations;
    }

    private function parseRelationOptions($field)
    {
        if (preg_match('/field=([a-z-_]+)/', $field, $mappedMatch)) {
            $options['field'] = $mappedMatch[1];
        }

        return $options;
    }

    /**
     * Определяет имя таблицы на основе имени класса
     */
    private function resolveTableName(string $className): string
    {
        $shortName = $this->reflection->getShortName();
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $shortName));
    }

    /**
     * Создает маппинг свойств класса на колонки таблицы
     */
    private function createPropertyMapping(): array
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

    /**
     * Определяет тип свойства
     */
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
     * Сохраняет объект в базу данных (вставка или обновление)
     */
    public function save(object $entity): bool
    {
        $primaryKey = null;
        $primaryValue = null;
        $columns = [];
        $values = [];

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
//
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
            $this->lastInsertId = $id;
            $this->setPropertyValue($entity, 'id', $id);
            return true;
        }

        return false;
    }

    public function getLastInsertId()
    {
        return $this->lastInsertId;
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
        $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$primaryKey} = ?";

        // Добавляем первичный ключ в конец значений для WHERE
        $values[] = $primaryValue;

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }

    /**
     * Находит объект по первичному ключу
     */
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


        $this->arResult = $data;
        $res = $this->hydrate($data);

        foreach ($this->relation as $k=>$rel)
        {
            $orm = new self($rel['target']);

            $method =  $rel['type'];
            $orm->$method($orm, $rel['target'],$rel['options']['field'],$id,$res);
        }

        return  $res;
    }

    private function ManyToOne( SimpleORM $orm, $propsName,$foreinKey,$val,$res): void
    {

    }

    public function OneToMany( SimpleORM $orm, $propsName,$foreinKey,$val,$res)
    {
        $cond[$foreinKey] = $val;
      $data =  $orm->findAllBy($cond);
      $res->posts = $data;

      $this->arResult = $data;

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
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->arResult[] = $data;
            $entity = $this->hydrate($data);
            $results[] = $entity;
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

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $entity = $this->hydrate($data);
//        $this->loadRelations($entity);

        return $entity;
    }


    /**
     * Находит все объекты
     */
    public function findAll($limit = 100,$offset = 0): array
    {

        $sql = "SELECT * FROM {$this->table} LIMIT {$limit} OFFSET {$offset}";
        $stmt = $this->pdo->query($sql);

        $results = [];
        while ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            if ($data)
                $this->arResult[] = $data;
            $results[] = $this->hydrate($data);
        }

        return $results;
    }

    public function toArray()
    {
        return $this->arResult;
    }


    /**
     * Удаляет объект из базы данных
     */
    public function delete(object $entity): bool
    {
        $primaryKey = null;
        $primaryValue = null;

        foreach ($this->mapping as $property => $config) {
            if ($config['primary']) {
                $primaryKey = $config['column'];
                $primaryValue = $this->getPropertyValue($entity, $property);
                break;
            }
        }

        if (!$primaryKey || $primaryValue === null) {
            throw new RuntimeException('Cannot delete entity without primary key');
        }

        $sql = "DELETE FROM {$this->table} WHERE {$primaryKey} = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$primaryValue]);
    }

    /**
     * Создает объект из данных базы данных
     */
    private function hydrate(array $data): object
    {
        $entity = $this->reflection->newInstanceWithoutConstructor();

        foreach ($this->mapping as $property => $config) {
            $column = $config['column'];
            if (array_key_exists($column, $data)) {
                $value = $data[$column];
                $this->setPropertyValue($entity, $property, $value);
            }
        }

        return $entity;
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

    /**
     * Устанавливает значение свойства объекта
     */
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


}