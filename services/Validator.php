<?php

/** 
 * PHP Validator
 * 
 * PHP version 7.2
 * 
 * @category Validator
 * @package  Validator
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */

namespace app\services;

/**
 * Validator class handle values validation 
 */
class Validator
{
    /**
     * Empty class constructor
     */
    public function __construct()
    {
    }

    /**
     * Validate given value using FILTER_VALIDATE_INT
     *
     * @param mixed $value - given value
     * 
     * @return integer
     */
    public function validateInt($value)
    {
        return filter_var($value, FILTER_VALIDATE_INT);
    }

    /**
     * Sanitize given value using FILTER_SANITIZE_SPECIAL_CHARS
     *
     * @param string $string - given string
     * 
     * @return string
     */
    public function sanitizeSpecialChars($string) : string
    {
        return filter_var(
            trim($string),
            FILTER_SANITIZE_SPECIAL_CHARS
        );
    }

}
