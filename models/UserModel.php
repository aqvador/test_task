<?php


namespace app\models;


use app\engine\OrmMysql;

/**
 * Class UserModel
 *
 * @package app\models
 * @property $id int
 * @property $email string
 */

class UserModel extends OrmMysql
{
    public function getTableName()
    {
        return 'users';
    }

    public function getDb()
    {
        return 'db';
    }

}