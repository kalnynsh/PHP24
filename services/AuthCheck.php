<?php
namespace app\services;


class AuthCheck
{
    protected $currentSession;

    /**
     * AuthCheck's class constructor
     */
    public function __construct()
    {
        $this->currentSession = Session::getInstance();
    }
    /**
     * Return user's status from SESSION
     *
     * @return bool
     */
    public function isAuth()
    {
        $isAuth = false;
        $user = $this->currentSession->get('user');

        if (isset($user['isAuth']) && $user['isAuth']) {
            $isAuth = true;
        }

        return $isAuth;
    }

    /**
     * Return user ID from SESSION
     *
     * @return string - userId or null
     */
    public function getUserID() : string
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
        $this->currentSession->set('user', ['userID' => $userEntity->id]);
        $this->currentSession->set('user', ['isAuth' => true]);
        $this->currentSession->set('user', ['name' => $userEntity->name]);
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
