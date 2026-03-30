<?php
namespace core;

class SinglePageBaseController
{

    private $state;

    public function __construct($state)
    {
        $this->state = new $state();
    }

    public function execute()
    {
       $this->state->execute();
    }

}