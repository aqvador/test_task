<?php


namespace app\base\action;


use app\base\BaseObject;
use app\base\controllers\WebController;
use app\engine\App;

abstract class Action extends BaseObject
{
    /**
     * @var $controller WebController
     */
    public $controller;

    public function __construct()
    {
        $this->controller = App::$config['request']['controller'];
    }

    /**
     * start component
     */
    abstract public function run();

}