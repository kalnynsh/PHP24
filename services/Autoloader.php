<?php

namespace app\services;

/**
 * Class using for autoload classes
 */
class Autoloader
{
    private $_fileExtension = '.php';

    /**
     * Include class
     *
     * @param string $className - class's name
     * 
     * @return bool
     */
    public function loadClass($className)
    {
        $className = str_replace(
            ['app\\', '\\'],
            [
                __DIR__ . '/../', DS
            ],
            $className
        );

        $className .= $this->_fileExtension;

        if (file_exists($className)) {
            include_once $className;

            return true;
        }

        echo \sprintf('%s not exists', $className);

        return false;
    }
}
