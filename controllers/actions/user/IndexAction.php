<?php


namespace app\controllers\actions\user;


use app\base\action\Action;

class IndexAction extends Action
{
    public $id;

    public function run()
    {
        if ($this->id) {
            return $this->controller->render('index');
        }
        return $this->controller->render('index');
    }

}