<?php
namespace modules\pages;

use modules\catalog\AStatesCatalog;

class NotState extends AStatesCatalog
{

    protected function getData(): array|bool
    {
        return false;
    }
}