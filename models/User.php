<?php
namespace app\models;
/**
 *  User model class
 */
class User extends DbModel
{
    protected $id;
    protected $login;
    protected $name;
    protected $password;
    protected $last_login;

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
        parent::__construct();
        $this->id = $id;
        $this->login = $login;
        $this->name = $name;
        $this->password = $password;
        $this->last_login = $last_login;
    }

    /**
     * Get DB table name
     *
     * @return void
     */
    public static function getTableName()
    {
        return 'users';
    }

    /**
     * Get user's row of data from DB by username
     * and password
     *
     * @param string $login - user's login
     * @param string $pswd  - user's name
     */
    public static function getUser($login, $pswd)
    {
        $sql = sprintf(
            "SELECT * FROM `%s` WHERE `login` = `:login`",
            static::getTableName()
        );
        $stmt = static::getConn()->prepare($sql);
        $stmt->setFetchMode(
            \PDO::FETCH_CLASS |
                \PDO::FETCH_PROPS_LATE,
            get_called_class()
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
