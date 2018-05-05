<?php
namespace app\models;

/**
 *  Material model class
 */
class Material extends DataEntity
{
    /**
     * Material properties
     *
     * @property int    $id           - material's ID
     * @property string $material_name - material name
     */
    public $id;
    public $material_name;
}
