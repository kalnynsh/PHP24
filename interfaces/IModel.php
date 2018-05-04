<?php
namespace app\interfaces;

/**
 * Interfaces for Model
 */
interface IModel
{
    /**
     * Get one row of data from DB by ID
     */
    public static function getOne(int $id);

    /**
     * Get all row data from DB
     */
    public static function getAll();

    /**
     * Get table name
     */
    public static function getTableName();
}
