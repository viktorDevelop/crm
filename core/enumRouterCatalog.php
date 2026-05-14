<?php
namespace core;

enum enumRouterCatalog: string
{
    case CATEGORY = 'category_code';
    case DEFAULT = 'default';
    case POST = 'post_code';

    public static function resolveRouterKey(array $inputData):self
    {
        if (!empty($inputData[self::POST->value])) return  self::POST;
        if (!empty($inputData[self::CATEGORY->value])) return  self::CATEGORY;
        return self::DEFAULT;
    }

    public function getAction(array $routesConfig):?string
    {

        return $routesConfig[$this->value]['action'] ?? null;
    }

    public function getTemplate(array $routesConfig):?string
    {
        return $routesConfig[$this->value]['template'] ?? null;
    }

    public function getModel(array $routesConfig):?string
    {
        return $routesConfig[$this->value]['model'] ?? null;
    }
}