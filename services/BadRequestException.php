<?php

namespace app\services;

/**
 * BadRequestException class for throw 
 * new Exception, $message = 'Invalid Request', 
 * $code = 404
 */
class BadRequestException extends \Exception
{
    protected $message = 'Invalid Request';
    protected $code = 404;
}
