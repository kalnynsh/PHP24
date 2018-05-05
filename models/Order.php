<?php
namespace app\models;

/**
 *  Order model class
 */
class Order extends DataEntity
{
    /**
     * Order's properties
     *
     * @property int    $id             - order's ID
     * @property string $order_number   - order's number
     * @property string $product_amount - product's number 
     * @property string $product_id     - product's ID 
     * @property string $user_id        - user's ID
     * @property string $created_at     - creation date, time
     * @property string $updated_at     - update date, time
     * @property string $status         - one of (
     *               'notactive', 'active', 'paid', 'waiting', 'delivered')
     */
    public $id;
    public $order_number;
    public $product_amount;
    public $product_id;
    public $user_id;
    public $created_at;
}
