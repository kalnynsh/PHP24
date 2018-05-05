<?php
namespace app\models;

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
}
