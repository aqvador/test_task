<?php


namespace app\controllers;


use app\base\controllers\WebController;
use app\controllers\actions\user\IndexAction;

class UserController extends WebController
{

//    public function actionIndex()
//    {
//        $this->render('index', ['admin' => 'index Бла Бла<br>']);
//    }

    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class,
            ]
        ];
    }
}