<?php
namespace core;

class RestBaseController
{
    /**
     * @var mixed|null
     */
    private mixed $handle;
    private $params = [];
    protected Request $request;


    public function __construct($params = [])
    {
//        send2Log($params);
        $this->request = new Request();
        
        $this->handle = $params['object'] ?? null;

    }

    public function execute()
    {
        $this->getController();
    }

    public function getController()
    {
        $objName = $this->handle;
        $objName = ucfirst($objName);
        if ($this->handle)
        {
            $this->handle = ucfirst($this->handle).'RestController';
            $this->handle = "\\components\\Admin\\Dashbord\\{$objName}\\".$this->handle;
            if (class_exists($this->handle))
            {
                $this->handle = new $this->handle;

                switch ($_SERVER['REQUEST_METHOD'])
                {
                    case "GET":
                        $this->handle->show();
                    break;

                    case "POST":
                        $this->handle->create();
                        break;

                    case "PATCH":
                        $this->handle->update();
                        break;
                    case "DELETE":
                        $this->handle->delete();
                        break;
                }
            }

        }
    }

    public function __call(string $handle, array $arguments)
    {


    }


}