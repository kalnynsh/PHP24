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
use app\base\App;
use app\services\Validator;

/**
 * User Controller
 */
class UserController extends Controller
{
    private $_authCheck;
    protected $request;
    protected $validator;
    protected $session;

    /**
     * Init property with AuthCheck entity
     */
    public function __construct(IRenderer $renderEngine)
    {
        parent::__construct($renderEngine);
        $this->_authCheck = new AuthCheck();
        $this->validator = new Validator();
        $this->request = App::call()->request;
        $this->session = App::call()->session;
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
        if ($this->request->isPost()) {

            $submitLogIn = $this->request->getPost('sumbit_login');

            if (!is_null($submitLogIn)) {

                $login = $this->request->getPost('user_login');
                $login = $this->validator->sanitizeSpecialChars($login);

                $pswd = $this->request->getPost('user_password');
                $pswd = $this->validator->sanitizeSpecialChars($pswd);

                $lastLogin = date('Y-m-d H:i:s');
            } else {
                $message = "Неправильный логин или пароль!";
                $this->redirect('/index.php/user/login');
                exit();
            }

            $userEntity = new User('', $login, '', $pswd, $lastLogin);
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
        $message = '';
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
        if ($this->session->destroy()) {
            $message = 'Спасибо за покупки!';
            $this->redirect('/index.php');
            exit();
        }

        return false;
    }
}
