<?php

namespace app\base;

use app\services\Db;
use app\services\Request;
use app\traits\TSingletone;

/**
 * Class App
 * 
 * @package  AppBase
 * @property Request $request
 * @property Db $db
 */
class App
{
    use TSingletone;

    public $config;
    /**
     * @var Storage
     */
    private $_components;
    /**
     * @var Request
     */
    private $_controller;
    /**
     * @var Request
     */
    private $_action;
    const DEFAULT_URI = 'product';

    /**
     * Static function
     * return one instance of class
     *
     * @return object
     */
    public static function call()
    {
        return static::getInstance();
    }

    /**
     * Run method - call runController().
     * Init: configuration property;
     *      _components property.
     * 
     * @param array $config - array of config
     * 
     * @return void
     */
    public function run($config)
    {
        $this->config = $config;
        $this->_components = new Storage();
        $this->runController();
    }

    /**
     * CreateComponent method - create new instance of given $name
     *
     * @param string $name - name of class
     * 
     * @return object|bool
     */
    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                $reflection = new \ReflectionClass($class);

                return $reflection->newInstanceArgs($params);
            }
        }
        return null;
    }

    /**
     * Run controller with action
     * using properties
     *
     * @return void
     */
    public function runController()
    {
        $this->_controller
            = $this->request->getControllerName() ? : self::DEFAULT_URI;
        $this->_action = $this->request->getActionName();

        $controllerClass
            = $this->config['controllers_namespaces']
            . ucfirst($this->_controller)
            . 'Controller';

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new \app\services\TemplateRenderer());
            $controller->runAction($this->_action);
        }
    }

    /**
     * Method __get return given name component
     *
     * @param string $name - component's name
     * 
     * @return string
     */
    public function __get($name)
    {
        return $this->_components->get($name);
    }
}
