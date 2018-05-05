<?php

namespace app\models;

/**
 * Abstract class for keeping Model properties 
 */
abstract class DataEntity extends Model
{
    const LIMIT_FROM = 0;
    const PER_PAGE = 6;
}
