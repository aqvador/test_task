<?php


namespace app\base\controllers;


use app\base\BaseObject;
use app\engine\App;

abstract class WebController extends BaseObject
{
    private $view;
    private $viewPath;
    private $viewControllerPath;
    private $defaultExtension = '.php';
    private $layoutPath;
    private $title = 'default title';

    public function __construct()
    {
        $this->layoutPath = App::$config['layoutPath'];
        $this->view = App::$config['view'];
        $this->viewPath = App::$config['basePath'] . '/views';
        $this->viewControllerPath = $this->viewPath . DS . $this->getClassMame();
    }

    private function _renderPartial($fullPath, $variables = [], $output = true)
    {
        extract($variables);
        if (strpos($fullPath, $this->defaultExtension) === false) {
            $fullPath = $fullPath . $this->defaultExtension;
        }

        if (file_exists($fullPath)) {
            if (!$output) {
                ob_start();
            }
            include $fullPath;
            return !$output ? ob_get_clean() : true;
        }
        throw new \Exception('Не удалось найти файл представления:  ' . $fullPath, 500);

    }

    /**
     * renderPartial - метод доступный в контроллере, для вывода файла шаблона.
     * Не запускает больше никаких файлов. Удобен при ajax вызове контроллера
     *
     * @params $filename - название шаблона в папке views/название контроллера/{}.php
     * @params $variables - ключи массива будут доступны в шаблоне как переменные с
     * теми же именами
     * @params $output - если указать false, то данные из шаблона не будут выведены в основной поток а будут возвращены методом
     *
     * @throws \Exception
     */
    public function renderPartial($filename, $variables = [], $output = true)
    {
        if (strpos($filename, '@') !== false) {
            $filename = substr($filename, 1);
            $file = $this->viewPath . DS . $this->layoutPath;
        } else {
            $file = $this->viewControllerPath;
        }
        $file = $file . DS . $filename;
        return $this->_renderPartial($file, $variables, $output);
    }

    /**
     * render - метод выполняет полный вывод страницы на экран. При этом в нее включается
     * содержимое файла шаблона $filename
     *
     * @params - все параметры идентичны renderPartial
     *
     * @throws \Exception
     */
    public function render($view, $variables = [], $output = true)
    {
        $content = array_merge(array('content' => $this->renderPartial($view, $variables, false)), $variables);
        return $this->_renderPartial($this->viewPath . DS . $this->layoutPath . DS . $this->view, $content, $output);
    }

    public function getClassMame()
    {
        $class = basename(str_replace(['Controller', '\\'], '/', get_called_class()));
        return strtolower($class);
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [];
    }

}