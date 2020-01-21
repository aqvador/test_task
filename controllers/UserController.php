<?php


namespace app\controllers;


use app\base\controllers\WebController;
use app\controllers\actions\user\IndexAction;
use app\controllers\actions\user\LoginAction;
use app\controllers\actions\user\SignUpAction;

class UserController extends WebController
{

    public function actions()
    {
        return [
            'index' => IndexAction::class,
            'login' => LoginAction::class,
            'sign-up' => SignUpAction::class
        ];
    }
}