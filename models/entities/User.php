<?php
namespace app\models\entities;
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
    public $password;
    public $password_hash;
    public $last_login;

    /**
     * User's constractor
     *
     * @param int    $id         - user's ID
     * @param string $login      - user's login
     * @param string $name       - user's name
     * @param string $password   - password
     * @param string $last_login - date of las login
     */
    public function __construct(
        $id = null,
        $login = null,
        $name = null,
        $password = null,
        $last_login = null
    ) {
        $this->id = $id;
        $this->login = $login;
        $this->name = $name;
        $this->password = $password;
        $this->last_login = $last_login;
    }
}
