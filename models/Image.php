<?php
namespace app\models;

/**
 *  Image model class
 */
class Image extends DataEntity
{
    /**
     * Image properties
     *
     * @property int    $id           - image's ID
     * @property string $image_name   - image name
     * @property \Date  $created_at   - image's creation date
     * @property \Date  $updated_at   - image's update date
     */
    public $id;
    public $image_name;
    public $created_at;
    public $updated_at;

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
