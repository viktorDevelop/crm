<?php
namespace core;

class RouterHelper
{
    private array $arParamsPage;
    private array $inputData;

    public function __construct(array $arParamsPage = [],array $inputData = [])
    {
        $this->arParamsPage = $arParamsPage;
        $this->inputData = $inputData;
    }

    public function getConfigPage()
    {
        $newAr = [];
        foreach ($this->arParamsPage as $k => $value)
        {
            $newAr[$value['name']] = $value;
        }

        $enmRouterCatalog = enumRouterCatalog::resolveRouterKey($this->inputData);
        send2Log($enmRouterCatalog->getAction($newAr));
    }

}