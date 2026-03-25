<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';


class FormBuilder
{

    public function setTemplate(string $string)
    {
    }
}

$form = new FormBuilder();
$form->setTemplate('admin/form/post/add');


class FormController
{
    /**
     * @return void
     * @method POST
     * send form data
     */
    public function actionSend()
    {

    }

    /**
     * @method GET
     * show view form popup
     */

    public function actionShowForm()
    {

    }

    /**
     * @return void
     * @method GET
     * show view
     */
    public function execute()
    {

    }
}

class SectionControler
{

}


$routes = [
    [
        'condition'=>'/',
        'rule'=>"controller=section&section=main,view=main&action=execute"
    ],
    [
        'condition'=>'/category/:section_code/:element_code',
        'rule'=>"controller=section&section=main,view=main&action=execute"
    ],
    [
        'condition'=>'#^/admin/(?:/(:P<controller>[a-z-]+)?)/?$#i',
        'rule'=>"controller=section&section=main,view=main&action=execute"
    ]
];


