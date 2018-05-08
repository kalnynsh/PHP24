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

use app\interfaces\IRenderer;
use app\models\Cart;
use app\services\Request;
use app\services\Session;

/**
 * Cart Controller
 */
class CartController extends Controller
{
    protected $session;
    protected $cartModel;

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
        $this->cartModel = new Cart();
    }

    /**
     * Default controller's action
     *
     * @return void
     */
    public function actionIndex()
    {
        $cart = $this->session->get('cart');
        $username = $this->session->get('user')['name'] ?? '';

        if ($this->cartModel->get()) {
            $cartProducts = $this->cartModel->get();
        } else {
            $cartProducts = [];
        }

        $params = [
            'products' => $cartProducts,
            'username' => $username,
        ];

        echo $this->render('cart', $params);
    }

    /**
     * Add product to Cart
     *
     * @return void
     */
    public function actionAdd()
    {
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['submit_add_to_cart'])) {
                $productId = filter_var(
                    $_POST['id'],
                    FILTER_VALIDATE_INT
                );
                $productAmount = filter_var(
                    $_POST['amount'],
                    FILTER_VALIDATE_INT
                );
            }
            $username = $this->session->get('user')['name'];
            $cartItems = [$productId => $productAmount];
            $this->session->set('cart', $cartItems);
            $cartProducts = $this->cartModel->get();

            $params = [
                'products' => $cartProducts,
                'username' => $username,
            ];

            echo $this->render('cart', $params);
        }

        $params = ['message' => $message, ];
        echo $this->render('cart', $params);
    }

}
