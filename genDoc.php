<?php
$generator = new \crm\AdvancedDocumentationGenerator('docs');
$generator_o = new \crm\DocumentationGenerator('docs');

$arFilesDir = scandir($_SERVER['DOCUMENT_ROOT'].'/dll');



foreach ($arFilesDir as $file)
{
    if (preg_match('~.php~',$file)){

        $arFiles[] = '\\crm\\controllers\\'.str_replace('.php','',$file);
    }
}
echo '<pre>';

foreach ($arFiles as $file)
{
    $generator->generate($file);
}


print_r($arFiles);

$generator_o->generate($arFiles);
