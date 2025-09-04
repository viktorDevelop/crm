<?php
namespace core;

use core\interfaces\StateInterface;

class CurrentState
{
    private  $section_code;
    private  $element_code;
    private ?StateInterface  $state = null;
    private string $sNameSpaceState;
    private string $template;

    public function __construct($section_code = null,
                                $element_code=null,
                                $sNameSpaceState = '',
                                $template = '')    {

        $this->section_code = $section_code;
        $this->element_code = $element_code;
        $this->sNameSpaceState = $sNameSpaceState;
        $this->template = $template;
    }

    public function getState()
    {
        $this->sectionListState();
        return $this->state;
    }

    private function sectionListState()
    {
        $nOject = $this->sNameSpaceState.'\\SectionList';
        $template = $this->template.'/SectionList';
        $oject = new $nOject($template);

        if (!$this->section_code && !$this->element_code)
            $this->state = $oject;
        else
            $this->itemsListState();
    }

    private function itemsListState()
    {
        $nOject = $this->sNameSpaceState.'\\ListItems';
        $template = $this->template.'/ListItems';
        if ($this->section_code && !$this->element_code)
            $this->state = new $nOject($template);
        else $this->itemState();

    }

    private function itemState()
    {
        $nOject = $this->sNameSpaceState.'\\Detail';
        $template = $this->template.'/Detail';
        $this->state = new $nOject($template);
    }

}