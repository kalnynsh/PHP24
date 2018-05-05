<?php
namespace app\models;

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
}
