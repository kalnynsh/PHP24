<?php

namespace app\models\repositories;

use app\models\Order;
use app\models\Repository;

/**
 * Child class of Repository
 * get DB table name,
 * get Entity class name
 */
class OrderRepository extends Repository
{
    /**
     * Return DB table name
     *
     * @return string
     */
    public function getTableName() : string
    {
        return 'orders';
    }

    /**
     * Return Entity class name
     *
     * @return string
     */
    public function getEntityClass() : string
    {
        return Order::class;
    }
}
