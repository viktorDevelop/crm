<?php
namespace core;


class SimpleOrm
{
    protected \ReflectionClass $reflection;
    private string $table;
    private array $mapping = [];
    private \PDO $pdo;

    /**
     * @throws \ReflectionException
     */
    public function __construct(string $modelClass)
    {
        $this->pdo = Database::getInstance();
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
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $shortName)) . 's';
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

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }

        return $this->hydrate($data);
    }
}