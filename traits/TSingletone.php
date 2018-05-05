<?php

namespace app\traits;

/**
 * Ttrait using for creation only one instance of any class
 */
trait TSingletone
{
    private static $_instance;

    /**
     * Empty __construct method
     */
    private function __construct()
    {
    }
    /**
     * Empty __clone method
     */
    private function __clone()
    {
    }
    /**
     * Empty __wakeup method
     */
    private function __wakeup()
    {
    }
    /**
     * Return only one instance of any class
     *   
     * @return static::$_instance
     */
    public static function getInstance()
    {
        if (is_null(static::$_instance)) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }
}
