<?php

/** 
 * PHP Controller
 * 
 * PHP version 7.2
 * 
 * @category Controllers
 * @package  Product_Controller
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */

namespace app\controllers;

use app\models\Product;

/**
 * Product Controller
 */
class ProductController extends Controller
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
     * Cart action
     *
     * @return void
     */
    public function actionCard()
    {
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

        $product = Product::getOne($id);
        // test
        $is_login = true;

        $params = [
            'product' => $product,
            'is_login' => $is_login,
        ];

        echo $this->render('card', $params);
    }

}
