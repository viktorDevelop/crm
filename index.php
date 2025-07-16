<?php
include $_SERVER['DOCUMENT_ROOT'].'/init.php';
//$routes = include $_SERVER['DOCUMENT_ROOT'].'/crm/routes.php';

//include $_SERVER['DOCUMENT_ROOT'].'/templates/template.php';
//(new \crm\core\Router($routes));

//\core\Application::run();

// get user/
// get user/{id}
// get user/{id}/posts
// POST user/
// PUT user
// DELETE user/{id}

// get posts/
// get posts/{id}
// get posts/{id}/comment
// POST posts/
// PUT posts
// DELETE posts/{id}

class Pages
{
    public ?int $id = null;
    public string $title;
    public string $preview;
    public string $keyword;
    public string $description;

    /**
     * @return string
     */
    public function getPreview(): string
    {
        return $this->preview;
    }

    /**
     * @param string $preview
     */
    public function setPreview(string $preview): void
    {
        $this->preview = $preview;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id ): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getKeyword(): string
    {
        return $this->keyword;
    }

    /**
     * @param string $keyword
     */
    public function setKeyword(string $keyword): void
    {
        $this->keyword = $keyword;
    }
}

$model = new \core\SimpleORM(Pages::class);

$page = new Pages();


//$page->setTitle('Главная');
//$page->setPreview('sdfsf');
//$page->setDescription('44dssd44');
//$page->setKeyword('dsdfwww');

//$model->findAllBy();

//$model->findAll();
//$res = $model->toArray();
echo '<pre>';
print_r($page);
//print_r($res);