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

use app\models\Product;
use app\models\Order;

/**
 * Cart Controller
 */
class CartController extends Controller
{
    /**
     * Default controller's action
     *
     * @return void
     */
    public function actionIndex()
    {
        $products = Product::getAll();
        $username = 'anonim';

        $params = [
            'products' => $products,
            'username' => $username,
        ];

        echo $this->render('catalog', $params);
    }

    /**
     * Add action
     *
     * @return void
     */
    public function actionAdd()
    {
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        $product = Product::getOne($id);

        $is_login = true; // temporary

        $params = [
            'product' => $product,
            'is_login' => $is_login,
        ];

        echo $this->render('card', $params);
    }

}
