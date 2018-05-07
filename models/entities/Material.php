<?php
namespace app\models\entities;

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

    /**
     * Material's constructor
     *
     * @param int    $id            - Material's ID
     * @param string $material_name - Material's name
     */
    public function __construct(
        $id = null,
        $material_name = null
    ) {
        $this->id = $id;
        $this->material_name = $material_name;
    }
}
