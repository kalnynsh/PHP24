<?php
namespace app\models;

/**
 *  Image model class
 */
class Image extends DataEntity
{
    public $id;
    public $image_name;
    public $date_created;
    public $date_updated;

    /**
     * Return DB table name
     *
     * @return string
     */
    public static function getTableName() : string
    {
        return 'images';
    }
}
