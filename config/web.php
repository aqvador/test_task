<?php


return [
    'basePath' => dirname(__DIR__),
    'webPath' => dirname(__DIR__) . '/web',
    'defaultRoute' => 'user/index',
    'db' => require 'db.php',
    'userClass' => \app\models\UserModel::class,
    'projectName' => 'Мирная процветающая компания',
    'view' => 'main',
    'layoutPath' => 'layout'
];