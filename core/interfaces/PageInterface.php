<?php
namespace core\interfaces;

use core\Request;

interface PageInterface
{
    public function actionMain(Request $request);
    public function actionSectionList(Request $request);
}