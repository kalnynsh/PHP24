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

use app\base\App;
use app\models\Cart;
use app\interfaces\IRenderer;

/**
 * Cart Controller
 */
class CartController extends Controller
{
    protected $session;
    protected $cartModel;
    protected $request;
    protected $validator;

    /**
     * Init property $renderer setting to passing 
     * IRenderer $render
     *
     * @param IRenderer $renderEngine - Engine for rendering
     */
    public function __construct(IRenderer $renderEngine)
    {
        parent::__construct($renderEngine);
        $this->session = App::call()->session;
        $this->request = App::call()->request;
        $this->validator = App::call()->validator;
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
        if ($this->request->isPost()) {
            $submitAddToCart = $this->request->getPost('submit_add_to_cart');
            $submitEditCart = $this->request->getPost('submit_edit_cart');

            if (!is_null($submitAddToCart) || !is_null($submitEditCart)) {

                $productId = $this->request->getPost('id');
                $productId = $this->validator->validateInt($productId);

                $productAmoun = $this->request->getPost('amount');
                $productAmount = $this->validator->validateInt($productAmoun);

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

        $message = '';
        $params = ['message' => $message, ];
        echo $this->render('cart', $params);
    }
}
