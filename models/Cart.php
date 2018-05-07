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
    protected $currentSession;

    /**
     * Cart's class constructor
     */
    public function __construct()
    {
        $this->currentSession = Session::getInstance();
    }

    /**
     * Add product to cart
     *
     * @param Product $productEntity - product entity
     * 
     * @return void
     */
    public function add(Product $productEntity, $amount)
    {
        $items = [];
        $items[$productEntity->id] = $amount;
        $this->currentSession->set('cart', $items);
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
        $cartItem = $this->currentSession->get('cart');
        $cartItem[$productEntity->id] = $newAmount;
        $this->currentSession->set('cart', $cartItem);
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
        $cartItem = $this->currentSession->get('cart');
        unset($cartItem[$productEntity->id]);
    }
}
