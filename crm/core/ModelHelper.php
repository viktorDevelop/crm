<?php
namespace crm\core;

Trait ModelHelper
{
    private $model;
    private $arResult =[];
    public function __construct(Model $model)
    {

        $this->model = $model;
    }

    public function get()
    {

        return $this->arResult;
    }

    public function bindData($field1,$field2, Model | array  $model,$name = '')
    {
        $this->arResult = $this->model->getByList();
        if (!is_array($model))
            $arData = $model->getByList();
        else
            $arData = $model;

        foreach ($this->arResult as  $k=>$item )
        {
            foreach ($arData as $key => $val)
            {

                if ($item[$field1] == $val[$field2])
                {
                    if ($name){
                        $this->arResult[$k][$name][] = $val;
                    }else{

                        $this->arResult[$k][] = $val;
                    }
                }
            }
        }

    }
}
