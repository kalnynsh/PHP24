<?php

namespace app\models;

use app\models\entities\User;
use app\models\entities\Product;
use app\models\repositories\ProductRepository;
use app\base\App;

/**
 * Cart class
 */
class Cart extends Model
{
    const NO_CART_ITEMS = false;
    protected $session;
    protected $productModel;
    protected $request;
    protected $validator;

    /**
     * Cart's class constructor
     */
    public function __construct()
    {
        $this->session = App::call()->session;
        $this->productRepoDriver = new ProductRepository();
        $this->request = App::call()->request;
        $this->validator = App::call()->validator;
    }

    /**
     * Get products from cart
     *
     * @return array of products objects and 'sum'=>100.00
     */
    public function get()
    {
        $cartItems = $this->session->get('cart');

        if (!$cartItems) {
            return self::NO_CART_ITEMS;
        }

        $sum = 0.0;
        $cartProducts = array();

        foreach ($cartItems as $item) {
            foreach ($item as $productId => $amount) {
                $productObject = $this->productRepoDriver->getOne($productId);
                $subtotal = $productObject->price * $amount;
                $sum = $sum + $subtotal;

                $cartProducts[$productObject->id] = [
                    $productObject,
                    $amount,
                    $subtotal
                ];
            }
        }
        $cartProducts['sum'] = $sum;

        return $cartProducts;
    }

    /**
     * Add product to cart
     *
     * @param Product $productEntity - product entity
     * @param int     $amount        - product's amount
     * 
     * @return void
     */
    public function add(Product $productEntity, int $amount)
    {
        $id = $this->request->getParams('id');
        $id = $this->validator->validateInt($id);

        $items = [];
        $items[$productEntity->id] = $amount;
        $this->session->set('cart', $items);
    }

    /**
     * Update product in cart
     *
     * @param Product $productEntity - product entity
     * @param integer $newAmount     - amount of product
     * 
     * @return void
     */
    public function update(Product $productEntity, $newAmount)
    {
        $cartItem = $this->session->get('cart');
        $cartItem[$productEntity->id] = $newAmount;
        $this->session->set('cart', $cartItem);
    }

    /**
     * Remove product from cart
     *
     * @param Product $productEntity - product entity
     * 
     * @return void
     */
    public function remove(Product $productEntity)
    {
        $cartItem = $this->session->get('cart');
        unset($cartItem[$productEntity->id]);
    }
}
