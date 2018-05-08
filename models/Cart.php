<?php

namespace app\models;

use app\services\Session;
use app\models\entities\User;
use app\models\entities\Product;

/**
 * Cart class
 */
class Cart extends Model
{
    protected $session;

    /**
     * Cart's class constructor
     */
    public function __construct()
    {
        $this->session = Session::getInstance();
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
        $items = [];
        $items[$productEntity->id] = $amount;
        $this->session->set('cart', $items);
    }

    /**
     * Update product in cart
     *
     * @param Product $productEntity - product entity
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
