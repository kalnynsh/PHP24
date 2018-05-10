<?php

namespace app\services;

/**
 * Class DB manage database using \PDO
 */
class Db
{
    private $_config;
    /** 
     * @var \PDO $_connection - \PDO object 
     */
    private $_connection;

    /**
     * Db's constructor
     *
     * @param string $driver   - driver
     * @param string $host     - host
     * @param string $login    - login
     * @param string $password - password
     * @param string $database - database
     * @param string $charset  - charset
     */
    public function __construct(
        $driver,
        $host,
        $login,
        $password,
        $database,
        $charset = "utf8"
    ) {
        $this->_config['driver'] = $driver;
        $this->_config['host'] = $host;
        $this->_config['login'] = $login;
        $this->_config['password'] = $password;
        $this->_config['database'] = $database;
        $this->_config['charset'] = $charset;
    }

    /**
     * Get new PDO object
     *
     * @return \PDO
     */
    public function getConnection() : \PDO
    {
        if (is_null($this->_connection)) {
            $options = [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ];
            $_connection = new \PDO(
                $this->_prepareDsnString(),
                $this->_config['login'],
                $this->$_config['password'],
                $options
            );
        }
        return $_connection;
    }

    /**
     * Prepare Dsn param for init \PDO
     *
     * @return string
     */
    private function _prepareDsnString() : string
    {
        return sprintf(
            "%s:host=%s;dbname=%s;charset=%s",
            $this->_config['driver'],
            $this->_config['host'],
            $this->_config['database'],
            $this->_config['charset']
        );
    }

    /**
     * String representation
     *
     * @return string
     */
    public function __toString()
    {
        return 'Db';
    }
}
