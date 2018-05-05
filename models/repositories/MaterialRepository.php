<?php

namespace app\models\repositories;

use app\models\Material;
use app\models\Repository;

/**
 * Child class of Repository
 * get DB table name,
 * get Entity class name
 */
class MaterialRepository extends Repository
{
    /**
     * Return DB table name
     *
     * @return string
     */
    public function getTableName() : string
    {
        return 'materials';
    }

    /**
     * Return Entity class name
     *
     * @return string
     */
    public function getEntityClass() : string
    {
        return Material::class;
    }
}
