<?php
namespace crm;
use crm\controllers\CategoryController;

class DocumentationGenerator
{
    private string $outputDirectory;
    private array $excludedMethods = ['__construct', '__destruct', '__clone'];

    public function __construct(string $outputDirectory = 'docs')
    {
        $this->outputDirectory = rtrim($outputDirectory, '/');
        if (!is_dir($this->outputDirectory)) {
            mkdir($this->outputDirectory, 0755, true);
        }
    }

    /**
     * Генерирует документацию для одного класса или массива классов
     */
    public function generate($classes): void
    {
        if (!is_array($classes)) {
            $classes = [$classes];
        }

        foreach ($classes as $class) {
            $this->generateClassDocumentation($class);
        }

        $this->generateIndex($classes);
    }

    /**
     * Генерирует документацию для одного класса
     */
    private function generateClassDocumentation(string $className): void
    {
        try {
//            $className = "\\crm\\controllers\\CategoryController";
            $reflection = new \ReflectionClass($className);
        } catch (\ReflectionException $e) {
            echo "Ошибка: класс {$className} не найден\n";
            return;
        }

        $filename = $this->outputDirectory . '/' . $this->getClassFilename($className);
        $content = $this->renderClassTemplate($reflection);

        file_put_contents($filename, $content);
        echo "Документация для класса {$className} создана: {$filename}\n";
    }

    /**
     * Генерирует индексный файл со списком всех классов
     */
    private function generateIndex(array $classes): void
    {
        $indexContent = "# Документация по классам\n\n";

        foreach ($classes as $className) {
            $filename = $this->getClassFilename($className);
            $indexContent .= "- [{$className}]({$filename})\n";
        }

        file_put_contents($this->outputDirectory . '/README.md', $indexContent);
        echo "Индексный файл создан: {$this->outputDirectory}/README.md\n";
    }

    /**
     * Генерирует имя файла для класса
     */
    private function getClassFilename(string $className): string
    {
        return str_replace('\\', '_', $className) . '.md';
    }

    /**
     * Шаблон для генерации документации класса
     */
    private function renderClassTemplate(\ReflectionClass $class): string
    {
        $content = "# Класс {$class->getName()}\n\n";

        // Описание класса
        $content .= $this->renderClassDescription($class);

        // Свойства
        $content .= $this->renderProperties($class);

        // Методы
        $content .= $this->renderMethods($class);

        return $content;
    }

    /**
     * Генерирует описание класса
     */
    private function renderClassDescription(\ReflectionClass $class): string
    {
        $content = "## Описание\n\n";

        $docComment = $class->getDocComment();
        if ($docComment) {
            $content .= $this->parseDocComment($docComment) . "\n";
        }

        $content .= "- **Пространство имен:** `{$class->getNamespaceName()}`\n";

        if ($parent = $class->getParentClass()) {
            $content .= "- **Родительский класс:** [`{$parent->getName()}`]({$this->getClassFilename($parent->getName())})\n";
        }

        $interfaces = $class->getInterfaceNames();
        if (!empty($interfaces)) {
            $content .= "- **Реализуемые интерфейсы:** " . implode(', ', array_map(function($i) {
                    return "[`{$i}`]({$this->getClassFilename($i)})";
                }, $interfaces)) . "\n";
        }

        $traits = $class->getTraitNames();
        if (!empty($traits)) {
            $content .= "- **Используемые трейты:** " . implode(', ', $traits) . "\n";
        }

        $content .= "\n";

        return $content;
    }

    /**
     * Генерирует раздел со свойствами класса
     */
    private function renderProperties(\ReflectionClass $class): string
    {
        $properties = $class->getProperties();
        if (empty($properties)) {
            return '';
        }

        $content = "## Свойства\n\n";
        $content .= "| Модификатор | Имя | Тип | Описание |\n";
        $content .= "|-------------|-----|-----|----------|\n";

        foreach ($properties as $property) {
            $modifiers = implode(' ', \Reflection::getModifierNames($property->getModifiers()));
            $name = $property->getName();
            $type = $property->hasType() ? (string)$property->getType() : 'mixed';
            $description = $this->parseDocComment($property->getDocComment());

            $content .= "| {$modifiers} | \${$name} | {$type} | {$description} |\n";
        }

        $content .= "\n";
        return $content;
    }

    /**
     * Генерирует раздел с методами класса
     */
    private function renderMethods(\ReflectionClass $class): string
    {
        $methods = array_filter(
            $class->getMethods(),
            fn($m) => !in_array($m->getName(), $this->excludedMethods)
        );

        if (empty($methods)) {
            return '';
        }

        $content = "## Методы\n\n";

        foreach ($methods as $method) {
            $content .= $this->renderMethod($method) . "\n";
        }

        return $content;
    }

    /**
     * Генерирует документацию для одного метода
     */
    private function renderMethod(\ReflectionMethod $method): string
    {
        $modifiers = implode(' ', \Reflection::getModifierNames($method->getModifiers()));
        $returnType = $method->hasReturnType() ? (string)$method->getReturnType() : 'mixed';
        $params = $this->renderMethodParameters($method);
        $description = $this->parseDocComment($method->getDocComment());

        $content = "### `{$modifiers} function {$method->getName()}({$params}): {$returnType}`\n\n";
        $content .= "{$description}\n\n";

        return $content;
    }

    /**
     * Генерирует строку с параметрами метода
     */
    private function renderMethodParameters(\ReflectionMethod $method): string
    {
        $params = [];

        foreach ($method->getParameters() as $param) {
            $paramStr = '';

            if ($param->hasType()) {
                $paramStr .= (string)$param->getType() . ' ';
            }

            $paramStr .= '$' . $param->getName();

            if ($param->isDefaultValueAvailable()) {
                $default = $param->getDefaultValue();
                $paramStr .= ' = ' . json_encode($default);
            }

            $params[] = $paramStr;
        }

        return implode(', ', $params);
    }

    /**
     * Парсит DocBlock комментарий
     */
    private function parseDocComment(?string $comment): string
    {
        if (!$comment) {
            return '';
        }

        // Удаляем начальные и конечные маркеры комментария
        $comment = preg_replace(['/^\/\*\*\s*/', '/\s*\*\/$/'], '', $comment);

        // Удаляем звездочки в начале строк
        $comment = preg_replace('/^\s*\*\s?/m', '', $comment);

        // Удаляем пустые строки в начале и конце
        $comment = trim($comment);

        return $comment;
    }
}