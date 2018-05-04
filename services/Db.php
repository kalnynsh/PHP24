<?php

namespace app\services;

require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

/**
 * Class DB manage database using \PDO
 */
class Db
{
    private static $_config = [
        'driver' => DB_CONNECTION,
        'host' => DB_HOST,
        'login' => DB_USERNAME,
        'password' => DB_PASSWORD,
        'database' => DB_DATABASE,
        'charset' => 'utf8'
    ];

    /** 
     * @var \PDO $_conn - \PDO object 
     */
    private static $_instance = null;

    /**
     * Return only one instance of Db class
     * Usage Db::getInstance() 
     * 
     * @return \PDO    
     */
    public static function getInstance()
    {
        if (is_null(static::$_instance)) {
            static::$_instance = static::_getConnection();
        }

        return static::$_instance;
    }

    /**
     * Get new PDO object
     *
     * @return \PDO
     */
    private static function _getConnection() : \PDO
    {
        $options = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ];
        $_connection = new \PDO(
            static::_prepareDsnString(),
            static::$_config['login'],
            static::$_config['password'],
            $options
        );

        return $_connection;
    }

    /**
     * Prepare Dsn param for init \PDO
     *
     * @return string
     */
    private static function _prepareDsnString() : string
    {
        return sprintf(
            "%s:host=%s;dbname=%s;charset=%s",
            static::$_config['driver'],
            static::$_config['host'],
            static::$_config['database'],
            static::$_config['charset']
        );
    }

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
}
