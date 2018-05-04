<?php
namespace app\models;

/**
 *  Category model class
 */
class Category extends DbModel
{
    protected $id;
    protected $name;

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
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Return DB table name
     *
     * @return string
     */
    public static function getTableName() : string
    {
        return 'categories';
    }
}
