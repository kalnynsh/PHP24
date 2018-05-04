<?php

namespace app\traits;

/**
 * Ttrait using for creation only one instance of any class
 */
trait TSingletone
{
    private static $_instance;

    private function __construct()
    {
    }
    private function __clone()
    {
    }
    private function __wakeup()
    {
    }
    /**
     * Return only one instance of any class
     *   
     */
    public static function getInstance()
    {
        if (is_null(static::$_instance)) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }
}
