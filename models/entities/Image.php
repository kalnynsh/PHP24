<?php
namespace app\models\entities;

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
     * Image's constructor
     *
     * @param int    $id           - Image's ID
     * @param string $image_name   - Image's name
     * @param string $date_created - creation date, time 
     * @param string $date_updated - update date, time  
     */
    public function __construct(
        $id = null,
        $image_name = null,
        $date_created = null,
        $date_updated = null
    ) {
        $this->id = $id;
        $this->image_name = $image_name;
        $this->date_created = $date_created;
        $this->date_updated = $date_updated;
    }
}
