<?php

/** 
 * Learning PHP
 * 
 * PHP version 7.2
 * 
 * @category Repository_Driver
 * @package  Model
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */

namespace app\models;

use app\services\Db;

/**
 * Base class for driving Data Base
 */
abstract class Repository
{
    protected $db;

    /**
     * Init property with PDO object
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * Get one row of data from DB by ID
     *
     * @param int $id - ID
     *
     * @return object
     */
    public function getOne(int $id)
    {
        $sql = sprintf(
            'SELECT * FROM `%s` WHERE id = :id',
            $this->getTableName()
        );
        $stmt = $this->db->prepare($sql);
        $stmt->setFetchMode(
            \PDO::FETCH_CLASS |
                \PDO::FETCH_PROPS_LATE,
            $this->getEntityClass()
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
    public function getAll()
    {
        $sql = sprintf(
            'SELECT * FROM `%s` LIMIT :limitFrom, :perPage',
            $this->getTableName()
        );
        $stmt = $this->db->prepare($sql);

        $limit = $this->getEntityClass()::LIMIT_FROM;
        $perPage = $this->getEntityClass()::PER_PAGE;

        $stmt->bindValue(
            ':limitFrom',
            $limit,
            \PDO::PARAM_INT
        );
        $stmt->bindValue(
            ':perPage',
            $perPage,
            \PDO::PARAM_INT
        );

        $stmt->execute();

        $info = $stmt->errorInfo();
        if ($info[0] !== \PDO::ERR_NONE) {
            die('We have : ' . $info[2]);
        }

        return $stmt->fetchAll(
            \PDO::FETCH_CLASS |
                \PDO::FETCH_PROPS_LATE,
            $this->getEntityClass()
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
        $dataEntityClassProps = $this->_getEntityClassPropsNames();

        if (!in_array($columnName, $dataEntityClassProps)) {
            return false;
        }

        $sql = sprintf('SELECT `%s` FROM `%s`', $columnName, $this->getTableName());
        $stmt = $this->db->query($sql);

        $info = $stmt->errorInfo();
        if ($info[0] !== \PDO::ERR_NONE) {
            die('We have : ' . $info[2]);
        }

        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * Delete row of data from DB child class table 
     * by self ID
     * 
     * @param DataEntity $entity - given data object
     *
     * @return bool
     */
    public function delete(DataEntity $entity) : bool
    {
        $id = $entity->id;
        $sql = sprintf('DELETE FROM %s WHERE id = :id', $this->getTableName());
        $stmt = $this->db->prepare($sql);
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
     * Insert data to DB using class object property
     * 
     * @param DataEntity $entity - given data object
     *
     * @return string - ID of last inserted row
     */
    public function insert(DataEntity $entity) : string
    {
        $params = [];
        $columns = [];

        foreach ($entity as $key => $value) {
            if ($key === 'id') {
                continue;
            }

            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }
        // $params[':id'] = null;
        // $columns[] = 'id';

        $columns = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));
        $tableName = $this->getTableName();

        $sql = sprintf(
            "INSERT INTO `%s` (%s) VALUES (%s)",
            $tableName,
            $columns,
            $placeholders
        );

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        $info = $stmt->errorInfo();
        if ($info[0] !== \PDO::ERR_NONE) {
            die('We have : ' . $info[2]);
        }

        $entity->id = $this->db->lastInsertId();

        return true;
    }

    /**
     * Update given data to child class table
     * 
     * @param DataEntity $entity - given data object
     * 
     * @return bool
     */
    public function update(DataEntity $entity) : bool
    {
        $set = '';
        $params = [':id' => $entity->id];

        foreach ($entity as $key => $value) {
            $set .= "`" .
                "{$key}" .
                "`" .
                "= :{$key}, ";
            $params[":{$key}"] = $value;
        }
        $set = substr($set, 0, -2);

        $tableName = $this->getTableName();

        $sql = sprintf(
            "UPDATE `%s` SET %s WHERE id = :id",
            $tableName,
            $set
        );

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        $info = $stmt->errorInfo();
        if ($info[0] !== \PDO::ERR_NONE) {
            die('We have : ' . $info[2]);
        }

        return true;
    }

    /**
     * Make choice insert() or update()
     * and calling insert or update method
     * 
     * @param DataEntity $entity - given data object
     * 
     */
    public function save(DataEntity $entity)
    {
        if ($entity->id) {
            return $this->update($entity);
        } else {
            return $this->insert($entity);
        }
    }

    /**
     * Return array of DataEntity properties
     * 
     * @return array
     */
    private function _getEntityClassPropsNames() : array
    {
        return array_keys(get_class_vars($this->getEntityClass()));
    }

    /**
     * Abstract method for child classes - get table name
     *
     */
    abstract public function getTableName();

    /**
     * Abstract method for child classes - get Entity class
     *
     */
    abstract public function getEntityClass();
}