<?php

/** 
 * PHP Controller
 * 
 * PHP version 7.2
 * 
 * @category Controllers
 * @package  Cart_Controller
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */

namespace app\controllers;

/**
 * Not found Controller for 404
 */
class NotfoundController extends Controller
{
    /**
     * Default controller's action
     *
     * @return void
     */
    public function actionIndex()
    {
        $params = [];

        echo $this->render('404', $params);
    }
}
