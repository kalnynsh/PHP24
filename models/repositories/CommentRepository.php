<?php

namespace app\models\repositories;

use app\models\entities\Comment;
use app\models\Repository;

/**
 * Child class of Repository
 * get DB table name,
 * get Entity class name
 */
class CommentRepository extends Repository
{
    /**
     * Return DB table name
     *
     * @return string
     */
    public function getTableName() : string
    {
        return 'comments';
    }

    /**
     * Return Entity class name
     *
     * @return string
     */
    public function getEntityClass() : string
    {
        return Comment::class;
    }
}
