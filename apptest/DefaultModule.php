<?php

namespace apptest;



use core\Template;

/**
 * DefaultModule, модуль для обработки страниц public
 */
class DefaultModule extends AHandle
{
    public function handle(string $request): ?string
    {
        if ($request == 'isPublic' || $request == '')
        {
            echo $this->execute();
        }
        return parent::handle($request);
    }

    public function execute()
    {
//        $tmp = new Template('blog');
//        $tmp->setTitle('ttt');
//        $tmp->setContent('category.list');
//        $tmp->show();
    }
}