<?php
namespace app\models\entities;

/**
 *  Comment model class
 */
class Comment extends DataEntity
{
    /**
     * Comment properties
     *
     * @property int    $id           - comment's ID
     * @property string $user_id      - user's ID
     * @property string $content      - comment's content 
     */
    public $id;
    public $user_id;
    public $content;

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
        $this->id = $id;
        $this->user_id = $user_id;
        $this->content = $content;
    }
}
