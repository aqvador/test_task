<?php


namespace app\base;


abstract class BaseObject
{
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            print_r($property);
            return $this->$property;
        }
        die("Unknown property $property in class " . get_called_class());
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            print_r($property);
            $this->$property = $value;
        }
        die("Unknown property $property in class " . get_called_class());
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            return $this->$method($arguments);
        }
        die("Unknown method $method in class " . get_called_class());
    }

}