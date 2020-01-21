<?php


namespace app\base;


abstract class BaseObject
{
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        throw new \Exception("Unknown property '$property' in class " . get_called_class(), 500);
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        throw new \Exception("Unknown property '$property' in class " . get_called_class(), 500);
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            return $this->$method($arguments);
        }
        throw new \Exception("Unknown property '$method' in class " . get_called_class(), 500);
    }

}