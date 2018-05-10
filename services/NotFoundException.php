<?php

namespace app\services;

/**
 * NotFoundException class for throw 
 * new Exception, $message = 'Object Not Found', 
 * $code = 404
 */
class NotFoundException extends \Exception
{
    protected $message = 'Object Not Found';
    protected $code = 404;
}
