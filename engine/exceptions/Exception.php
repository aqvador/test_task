<?php


namespace app\engine\exceptions;


use app\base\controllers\WebController;

class Exception extends WebController
{
    public function error($code = 404, $message = 'Страница не найдена')
    {
        return $this->render('error', compact('code', 'message'));
    }

    public function warning($code = 403, $message = 'Доступ запрещен')
    {
        return $this->render('error', compact('code', 'message'));
    }
}
