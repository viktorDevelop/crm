<?php
namespace modules\pages;

use core\interfaces\IRest;
use core\Responce;
use core\Template;
use modules\AModule;

class PagesModule extends AModule implements IRest
{

    protected function setCurrentStateListClass(): ?string
    {
        return NotState::class;
    }

    protected function setCurrentStateDetailClass(): ?string
    {
        return NotState::class;
    }

    public function admin()
    {
        $template = new Template('admin');
        $template->setContentView($this->templateName);
        $template->show();
    }

    public function actionShow()
    {
         Responce::send('200');
    }

    public function actionCreate()
    {
        Responce::send('200');
    }

    public function actionUpdate()
    {
        // TODO: Implement actionUpdate() method.
    }

    public function actionDelete()
    {
        // TODO: Implement actionDelete() method.
    }
}