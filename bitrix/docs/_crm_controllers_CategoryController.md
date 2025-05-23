# Класс crm\controllers\CategoryController

## Описание

CategoryController класс
класс для работы с постами
- **Пространство имен:** `crm\controllers`
- **Родительский класс:** [`crm\controllers\ARestController`](crm_controllers_ARestController.md)
- **Реализуемые интерфейсы:** [`crm\controllers\RestInterface`](crm_controllers_RestInterface.md)

## Методы

### `public function actionIndex(): mixed`

получить все посты
@return void


### `public function actionGetByCode(crm\core\Request $request): mixed`

получает одну запись поста по code
@param Request $request
@return void


### `public function actionGetById(crm\core\Request $request): mixed`

получает одну запись поста по id
@param Request $request
@return void


### `public function actionSave(crm\core\Request $request): mixed`

сохраняет пост, если нет то добавляет
@param Request $request
@return void


### `public function actionDelete(crm\core\Request $request): mixed`

удаляет пост
@param Request $request
@return void


