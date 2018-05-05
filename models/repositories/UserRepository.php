<?php

namespace app\models\repositories;

use app\models\User;
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
     * Get user's row of data from DB by username
     * and password
     *
     * @param string $login - user's login
     * @param string $pswd  - user's name
     * 
     * @return mixed - object or bool
     */
    public function getUser($login, $pswd)
    {
        $sql = sprintf(
            "SELECT * FROM `%s` WHERE `login` = `:login`",
            $this->getTableName()
        );
        $stmt = $this->db->prepare($sql);
        $stmt->setFetchMode(
            \PDO::FETCH_CLASS |
                \PDO::FETCH_PROPS_LATE,
            $this->getEntityClass()
        );

        $params = [':login' => $login];
        $stmt->execute($params);

        $user = $stmt->fetch();

        if (password_verify($pswd, $user->password)) {
            return $user;
        }

        return false;
    }
}
