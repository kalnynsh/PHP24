<?php
namespace app\models;

/**
 *  Product model class
 */
class Product extends DataEntity
{
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
