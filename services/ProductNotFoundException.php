<?php

namespace app\services;

/**
 * NotFoundProductException class for throw 
 * new Exception, $message = 'Product Not Found', 
 * $code = 404
 */
class ProductNotFoundException extends \Exception
{
    protected $message = 'Product Not Found';
    protected $code = 404;
}
