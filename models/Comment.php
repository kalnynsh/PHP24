<?php
namespace app\models;

/**
 *  Comment model class
 */
class Comment extends DbModel
{
    protected $id;
    protected $user_id;
    protected $content;

    /**
     * Comment's constructor
     *
     * @param int    $id      - comment's ID
     * @param int    $user_id - user's ID
     * @param string $content - comment's content
     */
    public function __construct(
        $id = null,
        $user_id = null,
        $content = null
    ) {
        parent::__construct();
        $this->id = $id;
        $this->user_id = $user_id;
        $this->content = $content;
    }

    /**
     * Return DB table name
     *
     * @return string
     */
    public static function getTableName() : string
    {
        return 'comments';
    }
}
