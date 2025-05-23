<?php
$arConfig['host'] = 'db';
$arConfig['user'] = 'bitrix';
$arConfig['db_name'] = 'bitrix';
$arConfig['password'] = '123';
$pdo = new \PDO(
    'mysql:dbname='.$arConfig['db_name'].';host='.$arConfig['host'],
    $arConfig['user'],
    $arConfig['password']);


class Category extends \crm\core\SimpleORM
{
    public ?int $id = null;
    private string $title;
    private string $alias;



    public function __construct($title ='',$alias ='')
    {
        $this->title = $title;
        $this->alias = $alias;
    }

    /**
     *
     * @return void
     */
    public function getPosts()
    {

    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

}

$orm = new \crm\core\SimpleORM($pdo, 'Category');


$ar = [
    'id'=>5,
    'title'=>'trwqfdf',
    'alias'=>'112edsaf'
];

extract($ar);

$cat_o = $orm->findAll(3,3);

foreach ($cat_o as $k=>$category)
{
    echo $category->getTitle();
}

//$cat_o->setTitle($title);
//$cat_o->setAlias($alias);
//$orm->save($cat_o);
//$orm->delete($cat_o);


echo '<pre>';



echo json_encode([
//    'id'=>$cat_o->getId(),
//    'title'=>$cat_o->getTitle(),
//    'alias'=>$cat_o->getAlias()
]);
print_r($cat_o);

$view = \crm\core\View::getInstance();
