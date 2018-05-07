<?php

namespace app\models\repositories;

use app\models\entities\DataEntity;
use app\models\entities\User;
use app\models\Repository;

/**
 * Child class of Repository
 * get DB table name,
 * get Entity class name
 */
class UserRepository extends Repository
{
    /**
     * Return DB table name
     *
     * @return string
     */
    public function getTableName() : string
    {
        return 'users';
    }

    /**
     * Return Entity class name
     *
     * @return string
     */
    public function getEntityClass() : string
    {
        return User::class;
    }

    /**
     * Get user's row of data from DB by 
     *  user's DataEntity example
     *
     * @param DataEntity $userEntity - user's Enity
     * 
     * @return mixed - object or bool
     */
    public function getUser(DataEntity $userEntity)
    {
        $sql = sprintf(
            "SELECT * FROM `%s` WHERE `login` = :login",
            $this->getTableName()
        );
        $stmt = $this->db->prepare($sql);
        $stmt->setFetchMode(
            \PDO::FETCH_CLASS |
                \PDO::FETCH_PROPS_LATE,
            $this->getEntityClass()
        );

        $params = [':login' => $userEntity->login];
        $stmt->execute($params);

        $info = $stmt->errorInfo();
        if ($info[0] !== \PDO::ERR_NONE) {
            die('We have : ' . $info[2]);
        }
        $userObj = $stmt->fetch();

        if ($userObj !== false) {
            if (password_verify(
                $userEntity->password,
                $userObj->password_hash
            )) {
                return $userObj;
            }
        }
        // echo sprintf('Object %s not found', $userEntity->login);

        return false;
    }

    /**
     * Get result of query (name) to DB by user's ID
     *
     * @param string $id - user's ID
     * 
     * @return - results of query to DB
     */
    function getUserById(string $id)
    {
        $sql = sprintf(
            "SELECT * FROM `%s` WHERE `id` = `:id`",
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
        $user = $stmt->fetch();

        return $user;
    }

    /**
     * Insert user's data to DB
     *
     * @param DataEntity $entity - user's DataEntity
     * 
     * @return - void
     */
    function registerUser(DataEntity $entity)
    {
        $params[':id'] = null;
        $columns[] = 'id';
        $lastlogin = date('Y-m-d H:i:s');

        $userData = [
            $entity->login,
            $entity->name,
            $entity->password_hash,  // password_hash($pswd, PASSWORD_DEFAULT);
            $last_login
        ];

        foreach ($userData as $key => $value) {
            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }
        $columns = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));
        $tableName = $this->getTableName();

        $sql = sprintf(
            "INSERT INTO `%s` (%s) VALUES (%s)",
            $tableName,
            $columns,
            $placeholders
        );
    }
}
