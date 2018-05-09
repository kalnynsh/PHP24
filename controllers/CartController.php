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
    const NEW_PRODUCT = true;
    const OLD_PRODUCT = true;

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
        $username = $this->session->get('user')['name'] ?? '';

        if ($this->cartModel->get()) {
            $cartProducts = $this->cartModel->get();
        } else {
            $cartProducts = [];
        }

        $cartSum = $cartProducts['sum'] ?? 0;
        if ($cartSum) {
            unset($cartProducts['sum']);
        }

        $params = [
            'products' => $cartProducts,
            'username' => $username,
            'cartSum' => $cartSum,
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
            if (isset($_POST['submit_add_to_cart'])
                || isset($_POST['submit_edit_cart'])) {

                $productId = filter_var(
                    $_POST['id'],
                    FILTER_VALIDATE_INT
                );
                $productAmount = filter_var(
                    $_POST['amount'],
                    FILTER_VALIDATE_INT
                );

                $username = $this->session->get('user')['name'];
                $cart = $this->session->get('cart');

                if (!isset($cart)) {
                    $cartCreateItem = [0 => [$productId => $productAmount]];
                    $this->session->set('cart', $cartCreateItem);
                } else {
                    $cartCount = count($cart);
                    $idx = 0;

                    foreach ($cart as $Item) {
                        if (!array_key_exists($productId, $Item)) {
                            $cartAddItem = [
                                ($cartCount + 1) => [$productId => $productAmount]
                            ];
                            $cartNewItem = array_merge($cart, $cartAddItem);
                        } else {
                            $cartUpdateItem = [
                                $idx => [$productId => $productAmount]
                            ];
                            $cartNewItem = array_replace($cart, $cartUpdateItem);
                        }
                        $idx++;
                    }
                    unset($idx);

                    $this->session->set('cart', $cartNewItem);
                }

                $cartProducts = $this->cartModel->get();
                $cartSum = $cartProducts['sum'];
                unset($cartProducts['sum']);

                $params = [
                    'products' => $cartProducts,
                    'username' => $username,
                    'cartSum' => $cartSum,
                ];
                echo $this->render('cart', $params);
            }
        }
        $params = ['message' => $message, ];
        echo $this->render('cart', $params);
    }
}
