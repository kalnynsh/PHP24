<?php
namespace app\models;

/**
 *  Product model class
 */
class Product extends DbModel
{
    protected $id;
    protected $category_id;
    protected $image_id;
    protected $material_id;
    protected $price;
    protected $product_name;
    protected $size;
    protected $amount;
    protected $color;
    protected $created_at;
    protected $updated_at;
    protected $currentProperties = [];
    protected $newProperties = [];

    /**
     * Product constructor
     *
     * @param int    $id           - product's ID
     * @param int    $category_id  - product's category ID
     * @param int    $image_id     - product's image ID
     * @param int    $material_id  - product's material ID
     * @param double $price        - product's price
     * @param string $product_name - product's name
     * @param string $size         - product's size
     * @param int    $amount       - product's amount
     * @param string $color        - product's color
     * @param int    $status       - product's status 1|0
     * @param \Date  $created_at   - product's creation date
     * @param \Date  $updated_at   - product's update's date
     */
    public function __construct(
        $id = null,
        $category_id = null,
        $image_id = null,
        $material_id = null,
        $price = null,
        $product_name = null,
        $size = null,
        $amount = null,
        $color = null,
        $status = null,
        $created_at = null,
        $updated_at = null
    ) {
        parent::__construct();
        $this->id = $id;
        $this->category_id = $category_id;
        $this->image_id = $image_id;
        $this->material_id = $material_id;
        $this->price = $price;
        $this->product_name = $product_name;
        $this->size = $size;
        $this->amount = $amount;
        $this->color = $color;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    /**
     * Return DB table name
     *
     * @return string
     */
    public static function getTableName() : string
    {
        return 'products';
    }
}
