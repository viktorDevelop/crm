<?php

namespace core\interfaces;

use core\Request;

interface RestService
{
    public function actionShowPage(Request $request);
    public function actionFind(Request $request);
    public function actionStore(Request $request);
    public function actionUpdate(Request $request);
    public function actionDelete(Request $request);
}