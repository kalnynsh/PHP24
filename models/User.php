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
     * @property int    $id         - user's ID
     * @property string $login      - user's login
     * @property string $name       - user's name
     * @property string $password   - password
     * @property string $last_login - date of las login
     */
    protected $id;
    protected $login;
    protected $name;
    protected $password;
    protected $last_login;
}
