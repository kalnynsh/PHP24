<?php
namespace app\services;

use app\base\App;
use app\models\entities\DataEntity;
/**
 * Class check user's credentials,
 * set session user's params
 */
class AuthCheck
{
    protected $currentSession;
    const USER_AUTH = true;
    const USER_NOT_AUTH = false;

    /**
     * AuthCheck's class constructor
     */
    public function __construct()
    {
        $this->currentSession = App::call()->session;
    }
    /**
     * Return user's status from SESSION
     *
     * @return bool
     */
    public function isAuth()
    {
        $isAuth = self::USER_NOT_AUTH;
        $user = $this->currentSession->get('user');

        if (isset($user['isAuth']) && $user['isAuth']) {
            $isAuth = self::USER_AUTH;
        }

        return $isAuth;
    }

    /**
     * Return user ID from SESSION
     *
     * @return string - userId or null
     */
    public function getUserId() : string
    {
        $user = $this->currentSession->get('user');

        if (isset($user['userId'])) {
            $userId = $user['userId'];
        } else {
            $userId = null;
        }

        return $userId;
    }

    /**
     * Set given values to SESSION
     *
     * @param DataEntity $userEntity - user's entity
     * 
     * @return void
     */
    public function setSessionParams(DataEntity $userEntity) : void
    {
        $sessionUserParams = [
            'userId' => $userEntity->id,
            'isAuth' => true,
            'name' => $userEntity->name,
        ];
        $this->currentSession->set('user', $sessionUserParams);
    }

    /**
     * Set given values to COOKIE
     *
     * @param string $userId - user's ID
     * @param string $login  - user's login
     * 
     * @return void
     */
    public function setCookieParams($userId, $login, $password)
    {
        setcookie('IDUser', $userId, time() + 3600 * 24 * 30, '/');
        setcookie('login', $login, time() + 3600 * 24 * 30, '/');
        setcookie(
            'password',
            password_hash($password, PASSWORD_DEFAULT),
            time() + 3600 * 24 * 30,
            '/'
        );
    }
}
