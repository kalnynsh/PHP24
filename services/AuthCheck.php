<?php
namespace app\services;


class AuthCheck
{
    /**
     * Return user's status from SESSION
     *
     * @return bool
     */
    public function isAuth()
    {
        $isAuth = false;

        if (isset($_SESSION['user']['isAuth']) && $_SESSION['user']['isAuth']) {
            $isAuth = true;
        }

        return $isAuth;
    }

    /**
     * Return userID from SESSION
     *
     * @return string - userID or ''
     */
    public function getUserID() : string
    {
        if (isset($_SESSION['user']['userID'])) {
            $userID = $_SESSION['user']['userID'];
        } else {
            $userID = '';
        }

        return $userID;
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
        session_start();
        $_SESSION['user']['userID'] = $userEntity->id;
        $_SESSION['user']['isAuth'] = true;
        $_SESSION['user']['name'] = $userEntity->name;
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
