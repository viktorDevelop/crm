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


    public function __construct($handle ='', $params = [])
    {

        $this->request = new Request($params);
        $this->handle = $handle ?? null;

    }

    public function execute()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if (!$this->handle)
            return false;

        $oCtrl = new $this->handle();
        $action = $this->request->getParams('action') ?? null;

        switch ($method){
            case "GET":
                return $oCtrl->show();
            case "POST":
                if ($action)
                {
                    $action = 'action'.ucfirst($action);
                    return $oCtrl->$action();
                }
                return $oCtrl->create();

            case "PATCH":return $oCtrl->update();
            case "DELETE":return $oCtrl->delete();
            default:return "";
        }
    }

    private function findClassByName($className)
    {
        $declaredClasses = get_declared_classes();

        foreach ($declaredClasses as $class) {
            if (stripos($class, $className) !== false) {
                echo "Найден класс: " . $class . "\n";
            }
        }
    }



    public function __call(string $handle, array $arguments)
    {

    }


}