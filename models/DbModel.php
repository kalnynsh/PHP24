<?php

/** 
 * Learning PHP
 * 
 * PHP version 7.2
 * 
 * @category DbModel
 * @package  Model
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */
namespace app\models;

use app\services\Db;

/**
 * DbModel abstact parent class
 * for User, Product and any model classes
 */
abstract class DbModel
{
    protected $id;
    const LIMIT_FROM = 0;
    const PER_PAGE = 6;
    protected $db;
    protected $privateProperties = [
        'currentProperties',
        'newProperties',
        'privateProperties',
        'db'
    ];
    protected $currentProperties = [];
    protected $newProperties = [];

    /**
     * DbModel's constructor
     *
     * Init $db with PDO object connection to DB
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * Static method get connection with DB
     *
     * @return \PDO
     */
    public static function getConn() : \PDO
    {
        return Db::getInstance();
    }

    /**
     * Abstract static method for child classes - get table name
     *
     */
    abstract public static function getTableName();

    /**
     * Get one row of data from DB by ID
     *
     * @param int $id - ID
     *
     * @return object
     */
    public static function getOne(int $id)
    {
        $sql = sprintf(
            'SELECT * FROM `%s` WHERE id = :id',
            static::getTableName()
        );
        $stmt = static::getConn()->prepare($sql);
        $stmt->setFetchMode(
            \PDO::FETCH_CLASS |
                \PDO::FETCH_PROPS_LATE,
            get_called_class()
        );

        $params = [':id' => $id];
        $stmt->execute($params);

        $info = $stmt->errorInfo();
        if ($info[0] !== \PDO::ERR_NONE) {
            die('We have : ' . $info[2]);
        }

        return $stmt->fetch();
    }

    /**
     * Get all row data from DB like objects
     *
     * @return array - of objects
     */
    public static function getAll()
    {
        $sql = sprintf(
            'SELECT * FROM `%s` LIMIT :limitFrom, :perPage',
            static::getTableName()
        );
        $stmt = static::getConn()->prepare($sql);
        $stmt->bindValue(':limitFrom', static::LIMIT_FROM, \PDO::PARAM_INT);
        $stmt->bindValue(':perPage', static::PER_PAGE, \PDO::PARAM_INT);

        $stmt->execute();

        $info = $stmt->errorInfo();
        if ($info[0] !== \PDO::ERR_NONE) {
            die('We have : ' . $info[2]);
        }

        return $stmt->fetchAll(
            \PDO::FETCH_CLASS |
                \PDO::FETCH_PROPS_LATE,
            get_called_class()
        );
    }

    /**
     * Get all data from DB table for column
     *
     * @param string $columnName - column name
     *
     * @return array|bool- result or false
     */
    public function getColumn(string $columnName)
    {
        if (!$this->isAllowed($columnName)) {
            return false;
        }

        $sql = sprintf('SELECT `%s` FROM `%s`', $columnName, static::getTableName());
        $stmt = static::getConn()->query($sql);

        $info = $stmt->errorInfo();
        if ($info[0] !== \PDO::ERR_NONE) {
            die('We have : ' . $info[2]);
        }

        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * Insert data to DB using class object property
     *
     * @return string - ID of last inserted row
     */
    public function insert() : string
    {
        if (empty($this->newProperties)) {
            $this->fillProperties();
        }

        $params = [];
        $columns = [];

        foreach ($this->newProperties as $key => $value) {
            if ($key === 'id') {
                continue;
            }

            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }

        $columns = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));
        $tableName = static::getTableName();

        $sql = sprintf(
            "INSERT INTO `%s` (%s) VALUES (%s)",
            $tableName,
            $columns,
            $placeholders
        );

        $stmt = static::getConn()->prepare($sql);
        $stmt->execute($params);

        $info = $stmt->errorInfo();
        if ($info[0] !== \PDO::ERR_NONE) {
            die('We have : ' . $info[2]);
        }

        return static::getLastInsertId();
    }

    /**
     * Save current and new object properies for next compare
     *
     * @return void
     */
    protected function fillProperties()
    {
        foreach ($this as $key => $value) {
            if ($this->isPrivate($key)) {
                continue;
            }
            $this->currentProperties["{$key}"] = $value;
            $this->newProperties["{$key}"] = $value;
        }
    }

    /**
     * Return last insert ID to DB row that using auto increment
     *
     * @return string
     */
    public static function getLastInsertId() : string
    {
        return static::getConn()->lastInsertId();
    }

    /**
     * Update given data to child class table
     *
     * @return bool
     */
    public function update() : bool
    {
        if (empty($this->newProperties)) {
            return false;
        }

        $newValuesArr = array_diff(
            $this->newProperties,
            $this->currentProperties
        );

        if (!empty($newValuesArr)) {
            $params[':id'] = $this->newProperties['id'];
            $set = '';

            foreach ($newValuesArr as $key => $value) {
                $set .= "`" .
                    "{$key}" .
                    "`" .
                    "= :{$key}, ";
                $params[":{$key}"] = $value;
            }
        } else {
            echo 'There is nothing to change';

            return false;
        }

        $set = substr($set, 0, -2);
        $tableName = static::getTableName();

        $sql = sprintf(
            "UPDATE `%s` SET %s WHERE id = :id",
            $tableName,
            $set
        );

        $stmt = static::getConn()->prepare($sql);
        $stmt->execute($params);

        $info = $stmt->errorInfo();
        if ($info[0] !== \PDO::ERR_NONE) {
            die('We have : ' . $info[2]);
        }

        return true;
    }

    /**
     * Make choice insert() or update()
     * 
     */
    public function save()
    {
        if (empty($this->newProperties)) {
            return $this->insert();
        }

        return $this->update();
    }

    /**
     * Delete row of data from DB child class table 
     * by self ID
     *
     * @return bool
     */
    public function delete() : bool
    {
        $id = $this->id;
        $sql = sprintf('DELETE FROM %s WHERE id = :id', static::getTableName());
        $stmt = static::getConn()->prepare($sql);
        $stmt->execute(
            [
                'id' => $id,
            ]
        );

        $info = $stmt->errorInfo();
        if ($info[0] !== \PDO::ERR_NONE) {
            die('We have : ' . $info[2]);
        }

        return true;
    }

    /**
     * Set new value of given property name
     *
     * @param string $name  - property's name
     * @param mixed  $value - property's value
     * 
     * @return void
     */
    public function __set(string $name, $value)
    {
        if (empty($this->newProperties)) {
            $this->fillProperties();
        }

        if ($this->isAllowed($name)) {
            $this->newProperties[$name] = $value;
        } else {
            return null;
        }

        if ($name == 'id') {
            $this->newProperties['id'] = $this->currentProperties['id'] ?? null;
        }
    }

    /**
     * Get value of given property name
     *
     * @param string $name - property's name
     * 
     * @return mixed
     */
    public function __get(string $name)
    {
        if (empty($this->currentProperties)) {
            // Fill currentProperties and newProperties
            $this->fillProperties();
        }

        if ($this->isAllowed($name)) {
            return $this->newProperties[$name];
        }

        echo sprintf('This property %s not exists.', $name);

        return null;
    }

    /**
     * Get allowed properties
     *
     * @return array - allowed properties
     */
    protected function getAllowedProperties() : array
    {
        return array_keys($this->currentProperties);
    }

    /**
     * Check if given name belongs 
     * to AllowedProperties array
     *
     * @param string $name - property name
     * 
     * @return boolean
     */
    protected function isAllowed(string $name) : bool
    {
        return array_key_exists($name, $this->currentProperties);
    }

    /**
     * Check if given name belongs 
     * to privateProperties array
     *
     * @param string $name - property name
     * 
     * @return boolean
     */
    protected function isPrivate(string $name) : bool
    {
        return in_array($name, $this->privateProperties);
    }
    /**
     * Check errors from PDO execute
     *
     * @param \PDO $query - PDO query
     * 
     * @return void
     */
    protected function errorCheck($query) : void
    {
        $info = $query->errorInfo();

        if ($info[0] !== \PDO::ERR_NONE) {
            die('We have : ' . $info[2]);
        }
    }
}
