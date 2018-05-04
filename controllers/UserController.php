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

use app\models\User;

/**
 * User Controller
 */
class UserController extends Controller
{
    /**
     * Default controller's action
     *
     * @return void
     */
    public function actionIndex()
    {
        $params = [];

        echo $this->render('login', $params);
    }

    /**
     * Login action
     *
     * @return void
     */
    public function actionLogin()
    {
        $userlogin = filter_input(
            INPUT_POST,
            'user_login',
            FILTER_SANITIZE_SPECIAL_CHARS
        );
// Not Finished
/*

        $is_login = true;

        $params = [
            'is_login' => $is_login,
        ];

        echo $this->render('cart', $params);
    }
         */
    }
