<?php
namespace crm;
class AdvancedDocumentationGenerator extends \crm\DocumentationGenerator
{
    /**
     * Улучшенный парсер DocBlock с поддержкой PHPDoc и PhpStorm аннотаций
     */
    protected function parseDocComment(?string $comment): string
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

        // Парсим специальные теги PHPDoc
        $comment = $this->parsePHPDocTags($comment);

        // Обрабатываем аннотации PhpStorm
        $comment = $this->parsePhpStormAnnotations($comment);

        return $comment;
    }

    /**
     * Парсит стандартные теги PHPDoc
     */
    private function parsePHPDocTags(string $comment): string
    {
        // Обработка @param, @return, @throws, @var и других тегов
        $comment = preg_replace_callback(
            '/@(\w+)\s+([^\s]+)\s*(.*)/',
            function ($matches) {
                $tag = $matches[1];
                $type = $matches[2];
                $description = $matches[3] ?? '';

                switch ($tag) {
                    case 'param':
                        return "**Параметр:** `{$type}` {$description}";
                    case 'return':
                        return "**Возвращает:** `{$type}` {$description}";
                    case 'throws':
                        return "**Может выбросить:** `{$type}` {$description}";
                    case 'var':
                        return "**Тип:** `{$type}` {$description}";
                    case 'deprecated':
                        return "> ⚠️ **Устарело:** {$description}";
                    case 'see':
                        return "**Смотрите также:** {$type} {$description}";
                    default:
                        return "**{$tag}:** `{$type}` {$description}";
                }
            },
            $comment
        );

        return $comment;
    }

    /**
     * Парсит аннотации PhpStorm
     */
    private function parsePhpStormAnnotations(string $comment): string
    {
        // Обработка @noinspection
        $comment = preg_replace(
            '/@noinspection\s+([^\s]+)/',
            '> **PhpStorm:** подавление инспекции `$1`',
            $comment
        );

        // Обработка @link (используется в PhpStorm для ссылок)
        $comment = preg_replace(
            '/@link\s+([^\s]+)\s*(.*)/',
            '[Ссылка: $2]($1)',
            $comment
        );

        return $comment;
    }

    /**
     * Улучшенный рендеринг метода с полной информацией из PHPDoc
     */
    protected function renderMethod(\ReflectionMethod $method): string
    {
        $modifiers = implode(' ', Reflection::getModifierNames($method->getModifiers()));
        $returnType = $method->hasReturnType() ? (string)$method->getReturnType() : 'mixed';
        $params = $this->renderMethodParameters($method);
        $description = $this->parseDocComment($method->getDocComment());

        $content = "### `{$modifiers} function {$method->getName()}({$params}): {$returnType}`\n\n";
        $content .= "{$description}\n\n";

        // Добавляем информацию о параметрах из PHPDoc
        $content .= $this->renderMethodParamsDetails($method);

        // Добавляем информацию о возвращаемом значении
        $content .= $this->renderMethodReturnDetails($method);

        // Добавляем информацию об исключениях
        $content .= $this->renderMethodThrowsDetails($method);

        return $content;
    }

    /**
     * Генерирует подробную информацию о параметрах метода
     */
    private function renderMethodParamsDetails(\ReflectionMethod $method): string
    {
        $docComment = $method->getDocComment();
        if (!$docComment) {
            return '';
        }

        $params = [];
        preg_match_all('/@param\s+([^\s]+)\s+\$([^\s]+)\s*(.*)/', $docComment, $matches, PREG_SET_ORDER);

        if (empty($matches)) {
            return '';
        }

        $content = "#### Параметры:\n\n";
        $content .= "| Тип | Имя | Описание |\n";
        $content .= "|-----|-----|----------|\n";

        foreach ($matches as $match) {
            $type = $match[1];
            $name = $match[2];
            $description = $match[3] ?? '';
            $content .= "| `{$type}` | `{$name}` | {$description} |\n";
        }

        $content .= "\n";
        return $content;
    }

    /**
     * Генерирует информацию о возвращаемом значении
     */
    private function renderMethodReturnDetails(\ReflectionMethod $method): string
    {
        $docComment = $method->getDocComment();
        if (!$docComment) {
            return '';
        }

        if (preg_match('/@return\s+([^\s]+)\s*(.*)/', $docComment, $matches)) {
            $type = $matches[1];
            $description = $matches[2] ?? '';

            $content = "#### Возвращаемое значение:\n\n";
            $content .= "- **Тип:** `{$type}`\n";
            if ($description) {
                $content .= "- **Описание:** {$description}\n";
            }
            $content .= "\n";

            return $content;
        }

        return '';
    }

    /**
     * Генерирует информацию о выбрасываемых исключениях
     */
    private function renderMethodThrowsDetails(\ReflectionMethod $method): string
    {
        $docComment = $method->getDocComment();
        if (!$docComment) {
            return '';
        }

        preg_match_all('/@throws\s+([^\s]+)\s*(.*)/', $docComment, $matches, PREG_SET_ORDER);

        if (empty($matches)) {
            return '';
        }

        $content = "#### Исключения:\n\n";

        foreach ($matches as $match) {
            $type = $match[1];
            $description = $match[2] ?? '';
            $content .= "- `{$type}`";
            if ($description) {
                $content .= ": {$description}";
            }
            $content .= "\n";
        }

        $content .= "\n";
        return $content;
    }

    /**
     * Улучшенный рендеринг свойств с информацией из @var
     */
    protected function renderProperties(\ReflectionClass $class): string
    {
        $properties = $class->getProperties();
        if (empty($properties)) {
            return '';
        }

        $content = "## Свойства\n\n";
        $content .= "| Модификатор | Имя | Тип | Описание |\n";
        $content .= "|-------------|-----|-----|----------|\n";

        foreach ($properties as $property) {
            $modifiers = implode(' ', Reflection::getModifierNames($property->getModifiers()));
            $name = $property->getName();

            // Получаем тип из объявления (PHP 7.4+)
            $typeFromDeclaration = $property->hasType() ? (string)$property->getType() : null;

            // Получаем тип из @var аннотации
            $docComment = $property->getDocComment();
            $typeFromDoc = null;
            $description = '';

            if ($docComment && preg_match('/@var\s+([^\s]+)\s*(.*)/', $docComment, $matches)) {
                $typeFromDoc = $matches[1];
                $description = $matches[2] ?? '';
            }

            // Приоритет у типа из объявления
            $type = $typeFromDeclaration ?? $typeFromDoc ?? 'mixed';

            $content .= "| {$modifiers} | \${$name} | {$type} | {$description} |\n";
        }

        $content .= "\n";
        return $content;
    }
}