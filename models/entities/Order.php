<?php
namespace app\models\entities;

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

    /**
     * Order's constructor
     *
     * @param int    $id             - order's ID
     * @param string $order_number   - order's number
     * @param string $product_amount - product's number 
     * @param string $product_id     - product's ID 
     * @param string $user_id        - user's ID
     * @param string $created_at     - creation date, time
     * @param string $updated_at     - update date, time
     * @param string $status         - one of (
     *               'notactive', 'active', 'paid', 'waiting', 'delivered')
     */
    public function __construct(
        $id = null,
        $order_number = null,
        $product_amount = null,
        $product_id = null,
        $user_id = null,
        $created_at = null,
        $updated_at = null,
        $status = null
    ) {
        $this->id = $id;
        $this->order_number = $order_number;
        $this->product_amount = $product_amount;
        $this->product_id = $product_id;
        $this->user_id = $user_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->status = $status;
    }
}
