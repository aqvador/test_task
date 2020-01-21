<?php


namespace app\engine;


use app\assets\AppAsset;
use app\engine\exceptions\Exception;

/**
 * Class App
 *
 * @package app\engine
 * @property Router $router
 */
class App
{
    public static $config;

    function __construct($config = false)
    {
        self::$config = new \ArrayObject($config, \ArrayObject::STD_PROP_LIST);
        self::$config->router = self::createObject(Router::class);
    }

    public function run()
    {

        try {
            self::$config->router->start();
        } catch (\Exception $e) {
            self::createObject(Exception::class)->error($e->getCode(), $e->getMessage());
        }
    }

    /**
     * @param string|array $type
     * @param array        $params
     *
     * @return bool|object
     */
    public static function createObject($type, $params = [])
    {
        if (is_string($type)) {
            return self::getObject($type, $params);
        }

        if (is_array($type)) {
            if (isset($type['class'])) {
                $class = $type['class'];
                unset($type['class']);
                return self::getObject($class, $type);
            }
        }
        return false;
    }

    /**
     * @param string|array $type
     * @param array        $params
     *
     * @return bool|object
     */
    public static function getObject($type, $params = null)
    {
        if (class_exists($type)) {
            $obj = new $type;
            if (is_array($params)) {
                foreach ($params as $property => $value) {
                    if (property_exists($obj, $property)) {
                        $obj->$property = $value;
                    }
                }
            }
            return $obj;
        }
        throw new \Exception('Unable to initialize the class ' . $type, 500);
    }

}