<?php

/** 
 * PHP Controller
 * 
 * PHP version 7.2
 * 
 * @category Controllers
 * @package  Order_Controller
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */

namespace app\controllers;

use app\interfaces\IRenderer;
use app\models\Cart;
use app\models\entities\Order;
use app\models\repositories\OrderRepository;
use app\base\App;

/**
 * Cart Controller
 */
class OrderController extends Controller
{
    protected $session;
    protected $cartModel;
    protected $orderRepoDriver;

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
        $this->cartModel = new Cart();
        $this->orderRepoDriver = new OrderRepository();
    }

    /**
     * Default controller's action
     *
     * @return void
     */
    public function actionIndex()
    {
        $username = $this->session->get('user')['name'] ?? '';
        $userId = $this->session->get('user')['userId'];
        $cartProducts = $this->session->get('cart');

        $message = '';
        $orderNumber = 0;

        if (!$cartProducts) {
            $message = 'У Вас не выбраны товары';
            echo $this->render('order', $params);
            die();
        }

        $date = date('Y-m-d H:i:s');
        $status = 'active';
        $orderNumber = uniqid();
        $orderEntityArray = [];

        foreach ($cartProducts as $item) {
            foreach ($item as $productId => $productAmount) {
                $orderEntityArray[]
                    = new Order(
                    null,
                    $orderNumber,
                    $productAmount,
                    $productId,
                    $userId,
                    $date,
                    $date,
                    $status
                );
            }
        }

        foreach ($orderEntityArray as $orderEntity) {
            $this->orderRepoDriver->insert($orderEntity);
        }

        $this->session->set('cart', null);

        $params = [
            'username' => $username,
            'orderNumber' => $orderNumber,
            'message' => $message,
        ];

        echo $this->render('order', $params);
    }

}
