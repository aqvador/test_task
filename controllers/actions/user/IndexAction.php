<?php


namespace app\controllers\actions\user;


use app\base\action\Action;
use app\engine\App;

class IndexAction extends Action
{
    public $id;

    public function run()
    {
        $this->id = App::$config['request']['params']['get']['id'] ?? false;

        if ($this->id) {
            return $this->controller->render('index', ['admin' => "Запрошен id '<b>$this->id</b>'<br>"]);
        }

        return $this->controller->render('index', ['admin' => "Ничего не запрошно<br>"]);
    }

}