<?php

namespace app\models;

/**
 * Abstract class for keeping Model properties 
 */
abstract class DataEntity extends Model
{
    /**
     * Get properties using only inside class
     *
     * @return array
     */
    // public static function getPersonalProperties() : array
    // {
    //     return [
    //         'currentProperties',
    //         'newProperties',
    //         'personalProperties',
    //         'db'
    //     ];
    // }
}
