<?php
namespace components\Catalog;

class CategoryComponent1
{
    protected $section_code = null;
    protected $element_code = null;
    protected $object = null;
    public function __construct($params = [])
    {
        $section = $this->section_code = $params['section_code'] ?? null;
        $element_code = $this->element_code = $params['element_code'] ?? null;

    }

    public function execute()
    {
        if (!$this->section_code)
        {
            $this->object = new CategoryListComponent();
            $this->object->view();
        }

        if ($this->section_code && !$this->element_code)
        {
            $this->object = new PostListComponent();
            $this->object->view();
        }
        if ($this->section_code && $this->element_code)
        {
            $this->object = new PostItemComponent();
            $this->object->view();
        }
    }

}