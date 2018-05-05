<?php
namespace app\models;
/**
 *  User model class
 */
class User extends DataEntity
{
    /**
     * User properties
     *
     * @property int    $id            - user's ID
     * @property string $login         - user's login
     * @property string $name          - user's name
     * @property string $password_hash - password_hash($pswd, PASSWORD_DEFAULT)
     * @property string $password      - password user's passord for check
     * @property string $last_login    - date of last login
     */
    public $id;
    public $login;
    public $name;
    public $password_hash;
    public $password;
    public $last_login;
}
