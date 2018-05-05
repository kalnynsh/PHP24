<?php

namespace app\models\repositories;

use app\models\Category;
use app\models\Repository;

/**
 * Child class of Repository
 * get DB table name,
 * get Entity class name
 */
class CategoryRepository extends Repository
{
    /**
     * Return DB table name
     *
     * @return string
     */
    public function getTableName() : string
    {
        return 'categories';
    }

    /**
     * Return Entity class name
     *
     * @return string
     */
    public function getEntityClass() : string
    {
        return Category::class;
    }
}
