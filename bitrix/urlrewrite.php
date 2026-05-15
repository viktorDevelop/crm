<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';

/**
 * @todo
 * сделать показ статической страницы /about
 * rest controller
 */
\core\Application::run();

//class PageModule implements \modules\catalog\ICatalog
//{
//
//    public function showList(\core\Request $request, string $model, string $templateName): void
//    {
//        // TODO: Implement showList() method.
//    }
//
//    public function showDetail(\core\Request $request, string $model, string $templateName): void
//    {
//        // TODO: Implement showDetail() method.
//    }
//}