<?php


namespace app\base\components;


use app\base\BaseObject;

abstract class Components extends BaseObject
{
    /**
     * start component
     */
    abstract public function run();

}