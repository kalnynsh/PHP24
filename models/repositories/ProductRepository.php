<?php

namespace app\models\repositories;

use app\models\Product;
use app\models\Repository;

/**
 * Child class of Repository
 * get DB table name,
 * get Entity class name
 */
class ProductRepository extends Repository
{
    /**
     * Return DB table name
     *
     * @return string
     */
    public function getTableName() : string
    {
        return 'products';
    }

    /**
     * Return Entity class name
     *
     * @return string
     */
    public function getEntityClass() : string
    {
        return Product::class;
    }
}
