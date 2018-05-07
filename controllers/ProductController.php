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

use app\interfaces\IRenderer;
use app\models\repositories\ProductRepository;
use app\services\Request;
use app\services\Session;

/**
 * Product Controller
 */
class ProductController extends Controller
{
    protected $session;

    /**
     * Init property $renderer setting to passing 
     * IRenderer $render
     *
     * @param IRenderer $renderEngine - Engine for rendering
     */
    public function __construct(IRenderer $renderEngine)
    {
        parent::__construct($renderEngine);
        $this->session = (new Session)::getInstance();
    }

    /**
     * Default controller's action
     *
     * @return void
     */
    public function actionIndex()
    {
        $products = (new ProductRepository())->getAll();
        $username = $this->session->get('user')['name'] ?? '';

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
        $id = filter_var((new Request())->getParams('id'), FILTER_VALIDATE_INT);
        $product = (new ProductRepository())->getOne($id);

        $is_login = $this->session->get('user')['isAuth'] ?? false;

        $params = [
            'product' => $product,
            'is_login' => $is_login,
        ];

        echo $this->render('card', $params);
    }

}
