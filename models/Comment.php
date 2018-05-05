<?php
namespace app\models;

/**
 *  Comment model class
 */
class Comment extends DataEntity
{
    public $id;
    public $user_id;
    public $content;
}
