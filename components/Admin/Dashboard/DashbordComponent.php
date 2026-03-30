<?php
namespace components\Admin\Dashbord;

use core\Template;

class DashbordComponent
{
    protected $section_code = null;
    protected $element_code = null;
    protected $object = null;
    protected $action = null;
    protected $template;

    public function __construct($params = [])
    {
        $params['action'] = $params['action'] ?? 'Show';
        $this->object =  $params['object'] ?? null;
        $action = $params['action'] ?? 'Show';
        $this->action = 'action'.ucfirst($action);
        $this->template = new Template('admin');

    }

    public function execute()
    {

        if ($this->object) {
            $obj_name = ucfirst($this->object);
            $obj = "\\components\\Admin\\Dashboard\\{$obj_name}\\" . $obj_name . 'Dashboard';

            if (class_exists($obj))
            {
                $obj = new $obj();
                if (method_exists($obj,$this->action))
                {
                    $obj->{$this->action}();
                }
            }
        }
    }
}

