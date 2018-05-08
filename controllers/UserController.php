<?php

/** 
 * PHP Controller
 * 
 * PHP version 7.2
 * 
 * @category Controllers
 * @package  User_Controller
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */

namespace app\controllers;

use app\models\entities\User;
use app\models\repositories\UserRepository;
use app\services\AuthCheck;
use app\interfaces\IRenderer;
use app\services\Session;

/**
 * User Controller
 */
class UserController extends Controller
{
    private $_authCheck;

    /**
     * Init property with AuthCheck entity
     */
    public function __construct(IRenderer $renderEngine)
    {
        parent::__construct($renderEngine);
        $this->_authCheck = new AuthCheck();
    }

    /**
     * Default controller's action
     *
     * @return void
     */
    public function actionIndex()
    {
        $params = ['message' => ''];

        echo $this->render('login', $params);
    }

    /**
     * Login action
     *
     * @return void
     */
    public function actionLogin()
    {
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['sumbit_login'])) {
                $login = filter_var(
                    trim($_POST['user_login']),
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
                $pswd = filter_var(
                    trim($_POST['user_password']),
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
                $lastLogin = date('Y-m-d H:i:s');
            } else {
                $message = "Неправильный логин или пароль!";
                $this->redirect('/index.php/user/login');
                exit();
            }

            $pswdHash = password_hash($pswd, PASSWORD_DEFAULT);
            $userEntity = new User('', $login, '', $pswd, $pswdHash, $lastLogin);

            $userDb = (new UserRepository())->getUser($userEntity);

            if ($userDb) {
                $this->_authCheck->setSessionParams($userDb);
                $this->redirect('/index.php');

                exit();
            } else {
                $message = "Неправильный логин или пароль!";
                $this->redirect('/index.php/user/login');
                exit();
            }
        }

        $params = ['message' => $message, ];
        echo $this->render('login', $params);
    }

    /**
     * Logout action
     *
     * @return void
     */
    public function actionLogout()
    {
        if ((new Session)::getInstance()->destroy()) {
            $message = 'Спасибо за покупки!';
            $this->redirect('/index.php');
            exit();
        }

        return false;
    }
}
