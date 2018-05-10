<?php

namespace app\services;

use app\services\BadRequestException;

/**
 * Class for parsing URI
 */
class Request
{
    protected $requestString;
    protected $controllerName;
    protected $actionName;
    /**
     * Array of $params = ['key'=> value]
     *
     * @var array
     */
    protected $params = [];
    protected $method;

    const POST_METHOD = 'post';

    /**
     * Init properties from $_SERVER['REQUEST_URI']
     * Call method parseRequest()
     */
    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = $_REQUEST ? : [];
        $this->parseRequest();
    }

    /**
     * Parse the requestString property
     * Init method property
     * 
     * @return void|bool
     */
    protected function parseRequest()
    {
        // $pattern
        //     = "#[/]?(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui"; 

        $pattern
            = "#[/]?index.php
            [/]?(?P<controller>\w+)[/]?
            (?P<action>\w+)?[/]?
            [?]?(?P<params>.*)?#ix";

        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];
        } else {
            // throw new BadRequestException();
            return false;
        }
    }

    /**
     * Get Controller name
     *
     * @return string
     */
    public function getControllerName() : string
    {
        return $this->controllerName ? : '';
    }

    /**
     * Get Action name
     *
     * @return string
     */
    public function getActionName() : string
    {
        return $this->actionName ? : '';
    }

    /**
     * Get query string params
     * like ['id' => 2]
     * 
     * @return mixed
     */
    public function getParams($key = null)
    {
        return $this->getArr($this->params, $key);
    }

    /**
     * Get Method name
     *
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * Check if method is POST
     *
     * @return boolean
     */
    public function isPost() : bool
    {
        return $this->method === self::POST_METHOD;
    }

    /**
     * Get hole array or given key's value
     *
     * @param array  $arr - given array
     * @param string $key - given key
     * 
     * @return array|string|boolean
     */
    protected function getArr(array $arr, string $key = null)
    {
        if (!$key) {
            return $arr;
        }

        if (isset($arr[$key])) {
            return $arr[$key];
        }

        return null;
    }
}
