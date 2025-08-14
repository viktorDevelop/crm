<?
namespace core\handlers;

abstract class BaseHandler
{

    private $objectController;

    public function __construct($objectController)
    {
        $this->objectController = $objectController;
    }

    public function handle()
    {
        if (!class_exists($this->objectController))
            return false;

        $objectController_o = new $this->objectController();
       return $objectController_o->{$this->getAction()}();
    }

    abstract protected function getAction();
}
