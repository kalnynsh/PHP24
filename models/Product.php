<?php
namespace app\models;

/**
 *  Product model class
 */
class Product extends DataEntity
{
    /**
     * Product properties
     *
     * @property int    $id           - product's ID
     * @property int    $category_id  - product's category ID
     * @property int    $image_id     - product's image ID
     * @property int    $material_id  - product's material ID
     * @property double $price        - product's price
     * @property string $product_name - product's name
     * @property string $size         - product's size
     * @property int    $amount       - product's amount
     * @property string $color        - product's color
     * @property int    $status       - product's status 1|0
     * @property \Date  $created_at   - product's creation date
     * @property \Date  $updated_at   - product's update's date
     */
    public $id;
    public $category_id;
    public $image_id;
    public $material_id;
    public $price;
    public $product_name;
    public $size;
    public $amount;
    public $color;
    public $created_at;
    public $updated_at;
}
