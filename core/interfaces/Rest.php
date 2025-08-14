<?php
namespace core\interfaces;

interface Rest
{
    public function actionFind();
    public function actionStore();
    public function actionUpdate();
    public function actionDelete();
}
