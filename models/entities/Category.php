<?php
namespace app\models\entities;

/**
 *  Category model class
 */
class Category extends DataEntity
{
    /**
     * Category properties
     *
     * @property int    $id           - category's ID
     * @property string $product_name - category's name
     */
    public $id;
    public $name;

    /**
     * Category's constructor
     *
     * @param int    $id   - category's ID
     * @param string $name - category's name
     */
    public function __construct(
        $id = null,
        $name = null
    ) {
        $this->id = $id;
        $this->name = $name;
    }
}
