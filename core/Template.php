<?php
namespace core;
class Template
{
    protected $tmpName;
    protected $templateData = [];
    protected $tmp;
    public function __construct($tmpName)
    {
        $this->tmpName = $tmpName;
    }

    public function render($path,$data = [])
    {
        $path = str_replace('.','/',$path);
        $path = '/'.$path;
        foreach ($data as $k=>$v)
        {
            $$k = $v;
        }
        ob_start();
        $path = $_SERVER['DOCUMENT_ROOT'].'/templates/'.$this->tmpName.$path.'/template.php';
        if (file_exists($path))
            include $path;
        $content = ob_get_contents();
        ob_clean();

        return $content;
    }

    public function setTitle($title)
    {
        $v = $this->render('');
        $this->tmp = str_replace('#title#',$title,$v);

    }

    public function setContent($view,$data = [])
    {

        $vc = $this->render($view,$data);
        $this->tmp = str_replace('#content#',$vc, $this->tmp);
    }



    public function setViewLayout($view,$data = [])
    {
        $vc = $this->render($view,$data);
        $this->tmp = str_replace('#'.$view.'#',$vc, $this->tmp);
    }

    public function show()
    {
        echo $this->tmp;
    }


}