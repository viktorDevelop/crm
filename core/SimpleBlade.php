<?php
namespace core;

class SimpleBlade
{
    private $templateDir;
    private $cacheDir;
    private $vars = [];

    public function __construct(string $templateDir, string $cacheDir = null)
    {
         $this->templateDir = $_SERVER['DOCUMENT_ROOT'].rtrim($templateDir, '/') . '/';
         $this->cacheDir = $_SERVER['DOCUMENT_ROOT'].$cacheDir ? rtrim($cacheDir, '/') . '/' : null;
    }

    public function assign($key, $value = null): void
    {
        if (is_array($key)) {
            $this->vars = array_merge($this->vars, $key);
        } else {
            $this->vars[$key] = $value;
        }
    }

    public function render(string $template, array $context = []): string
    {
         $templatePath = $this->templateDir . $template;
        if (!file_exists($templatePath)) {
            throw new RuntimeException("Template file not found: {$template}");
        }

        // Объединяем глобальные и локальные переменные


        $vars = array_merge($this->vars, $context);

        // Извлекаем переменные в текущую область видимости
        extract($vars, EXTR_SKIP);

        // Начинаем буферизацию вывода
        ob_start();

        // Включаем шаблон
        include $this->compile($templatePath, $vars);

        // Возвращаем содержимое буфера
        return ob_get_clean();
    }

    private function compile(string $templatePath, array $vars): string
    {
        if ($this->cacheDir === null) {
            return $this->compileTemplate($templatePath);
        }

       echo $cacheFile = $this->cacheDir . md5($templatePath) . '.php';

        // Если кэш не существует или шаблон был изменен
        if (!file_exists($cacheFile) || filemtime($templatePath) > filemtime($cacheFile)) {
            $compiled = $this->compileTemplate($templatePath);
            file_put_contents($cacheFile, $compiled);
        }

        return $cacheFile;
    }

    private function compileTemplate(string $templatePath): string
    {
        $templateContent = file_get_contents($templatePath);

        // Заменяем простые конструкции шаблона на PHP-код
        $replacements = [
            '/\{\{\s*(.+?)\s*\}\}/' => '<?php echo htmlspecialchars($1, ENT_QUOTES, \'UTF-8\') ?>',
            '/\{\%\s*if\s*(.+?)\s*\%\}/' => '<?php if ($1): ?>',
            '/\{\%\s*else\s*\%\}/' => '<?php else: ?>',
            '/\{\%\s*elseif\s*(.+?)\s*\%\}/' => '<?php elseif ($1): ?>',
            '/\{\%\s*endif\s*\%\}/' => '<?php endif; ?>',
            '/\{\%\s*foreach\s*(.+?)\s*as\s*(.+?)\s*\%\}/' => '<?php foreach ($1 as $2): ?>',
            '/\{\%\s*endforeach\s*\%\}/' => '<?php endforeach; ?>',
            '/\{\%\s*for\s*(.+?)\s*\%\}/' => '<?php for ($1): ?>',
            '/\{\%\s*endfor\s*\%\}/' => '<?php endfor; ?>',
            '/\{\%\s*include\s*[\'"](.+?)[\'"]\s*\%\}/' => '<?php echo $this->render(\'$1\', get_defined_vars()) ?>',
        ];

        $compiled = preg_replace(array_keys($replacements), array_values($replacements), $templateContent);

        return $compiled;
    }
}

//class SimpleBlade
//{
//    protected $path;
//    protected $cachePath;
//    protected $variables = [];
//
//    public function __construct($path, $cachePath)
//    {
//       $this->path = $_SERVER['DOCUMENT_ROOT'].rtrim($path, '/') . '/';
//        $this->cachePath = $_SERVER['DOCUMENT_ROOT']. rtrim($cachePath, '/') . '/';
//
//        if (!is_dir($this->cachePath)) {
//            mkdir($this->cachePath, 0755, true);
//        }
//    }
//
//    public function render($view, $data = [])
//    {
//        $this->variables = $data;
//
//         $templateFile = $this->path . $view . '.blade.php';
//         $cacheFile = $this->cachePath . md5($view) . '.php';
//
//        if (!file_exists($templateFile)) {
//            throw new \Exception("Template file not found: " . $templateFile);
//        }
//
//        // Если шаблон изменился или кэш отсутствует - компилируем заново
//        if (!file_exists($cacheFile) || filemtime($templateFile) > filemtime($cacheFile)) {
//            $compiled = $this->compile(file_get_contents($templateFile));
//            file_put_contents($cacheFile, $compiled);
//        }
//
//        extract($this->variables);
//
//        ob_start();
//        include $cacheFile;
//        return ob_get_clean();
//    }
//
//    protected function compile($content)
//    {
//        // Обработка наследования шаблонов
//        $content = $this->compileExtends($content);
//
//        // Обработка секций
//        $content = $this->compileSections($content);
//
//        // Обработка вставки секций
//        $content = $this->compileYields($content);
//
//        // Обработка переменных
//        $content = $this->compileVariables($content);
//
//        // Обработка циклов
//        $content = $this->compileLoops($content);
//
//        // Обработка условий
//        $content = $this->compileConditions($content);
//
//        // Обработка include
//        $content = $this->compileIncludes($content);
//
//        return $content;
//    }
//
//    protected function compileExtends($content)
//    {
/*        return preg_replace('/@extends\(\'(.+?)\'\)/', '<?php $this->extend("$1"); ?>', $content);*/
//    }
//
//    protected function compileSections($content)
//    {
/*        return preg_replace('/@section\(\'(.+?)\'\)/', '<?php $this->startSection("$1"); ?>', $content);*/
//    }
//
//    protected function compileYields($content)
//    {
/*        return preg_replace('/@yield\(\'(.+?)\'\)/', '<?php echo $this->yieldSection("$1"); ?>', $content);*/
//    }
//
//    protected function compileVariables($content)
//    {
/*        return preg_replace('/\{\{(.+?)\}\}/', '<?php echo htmlspecialchars($1, ENT_QUOTES); ?>', $content);*/
//    }
//
//    protected function compileLoops($content)
//    {
/*        $content = preg_replace('/@foreach\s*\((.+?)\)/', '<?php foreach($1): ?>', $content);*/
/*        $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);*/
//
/*        $content = preg_replace('/@for\s*\((.+?)\)/', '<?php for($1): ?>', $content);*/
/*        $content = preg_replace('/@endfor/', '<?php endfor; ?>', $content);*/
//
/*        $content = preg_replace('/@while\s*\((.+?)\)/', '<?php while($1): ?>', $content);*/
/*        $content = preg_replace('/@endwhile/', '<?php endwhile; ?>', $content);*/
//
//        return $content;
//    }
//
//    protected function compileConditions($content)
//    {
/*        $content = preg_replace('/@if\s*\((.+?)\)/', '<?php if($1): ?>', $content);*/
/*        $content = preg_replace('/@elseif\s*\((.+?)\)/', '<?php elseif($1): ?>', $content);*/
/*        $content = preg_replace('/@else/', '<?php else: ?>', $content);*/
/*        $content = preg_replace('/@endif/', '<?php endif; ?>', $content);*/
//
//        return $content;
//    }
//
//    protected function compileIncludes($content)
//    {
/*        return preg_replace('/@include\(\'(.+?)\'\)/', '<?php echo $this->render("$1", get_defined_vars()); ?>', $content);*/
//    }
//
//    // Методы для работы с наследованием шаблонов
//    protected $sections = [];
//    protected $currentSection = null;
//    protected $extends = null;
//
//    public function extend($view)
//    {
//        $this->extends = $view;
//    }
//
//    public function startSection($name)
//    {
//        $this->currentSection = $name;
//        ob_start();
//    }
//
//    public function endSection()
//    {
//        if (!is_null($this->currentSection)) {
//            $this->sections[$this->currentSection] = ob_get_clean();
//            $this->currentSection = null;
//        }
//    }
//
//    public function yieldSection($name)
//    {
//        file_put_contents('log.log',$this->sections,FILE_APPEND);
//        return isset($this->sections[$name]) ? $this->sections[$name] : '';
//    }
//
//
//}