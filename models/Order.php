<?php
namespace app\models;

/**
 *  Order model class
 */
class Order extends DbModel
{
    protected $id;
    protected $order_number;
    protected $product_amount;
    protected $product_id;
    protected $user_id;
    protected $created_at;

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
        parent::__construct();
        $this->id = $id;
        $this->order_number = $order_number;
        $this->product_amount = $product_amount;
        $this->product_id = $product_id;
        $this->user_id = $user_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->status = $status;
    }

    /**
     * Return DB table name
     *
     * @return string
     */
    public static function getTableName() : string
    {
        return 'orders';
    }
}
