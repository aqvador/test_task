<?php


namespace app\engine;


use app\base\action\Action;
use app\base\BaseObject;
use app\base\controllers\WebController;

Class Router extends BaseObject
{

    private $path;


    public function __construct()
    {
        $this->path = App::$config['basePath'] . '/controllers/';
        if (!empty($_POST)) {
            App::$config['request']['params']['post'] = $_POST;
        }
    }


    // определение контроллера и экшена из урла
    private function getController(&$controller, &$action, &$router)
    {
        $route = $router = $_GET['route'] ?? '';
        unset($_GET['route']);

        // Получаем части урла
        $route = trim($route, '/\\');
        $parts = explode('/', $route);

        // Находим контроллер экшен и берем параметры с запроса GET
        if (class_exists($this->getControllerName($parts[0]))) {
            $controller = $this->getControllerName(array_shift($parts));
            $action = $parts ? ucfirst(array_shift($parts)) : 'Index';
            App::$config['request']['params']['get'] = $_GET;
        } elseif (empty($parts[0])) {
            $controller = $this->getControllerName(explode('/', App::$config['defaultRoute'])[0]);
            $action = ucfirst(explode('/', App::$config['defaultRoute'])[1]);
        }
    }

    function start()
    {
        // Анализируем путь
        $this->getController($controller, $action, $router);

        if (!class_exists($controller)) {
            throw new \Exception("Не удалось определить маршрут <b>'$router'</b>", 404);
        }

        /**
         * @var $controller WebController;
         */
        $controller = App::createObject($controller);
        // Создаём экземпляр контроллера
        App::$config['request']['controller'] = $controller;
        // Если экшен не существует - 404
        if (method_exists($controller, 'action' . $action) == false) {
            $action = strtolower($action);
            if (method_exists($controller, 'actions') == true) {
                $actions = $controller->actions();
                if (isset($actions[$action])) {
                    $action = App::createObject($actions[$action]);
                    if ($action instanceof Action) {
                        // Выполняем экшен
                        return $action->run();
                    }
                }
            }
            throw new \Exception("Не удалось найти экшен: <b>'$action'</b>", 404);
        }
        // Выполняем экшен
        $action = 'action' . $action;
        return $controller->$action();
    }

    public function getControllerName($controller)
    {

        return $controller ? 'app\\controllers\\' . ucfirst($controller) . 'Controller' : false;
    }
}