<?php

namespace app\services;

require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
require_once ROOT_DIR . '/config/app.php';

/**
 * Class using for autoload classes
 */
class Autoloader
{
    private $_fileExtension = '.php';
    private $_app = APP_NAME . '\\';

    /**
     * Include class
     *
     * @param string $className - class name
     * 
     * @return bool
     */
    public function loadClass($className)
    {
        $className = str_replace(
            [$this->_app, '\\'],
            [
                ROOT_DIR . DIRECTORY_SEPARATOR,
                DIRECTORY_SEPARATOR
            ],
            $className
        );
        $className .= $this->_fileExtension;

        if (file_exists($className)) {
            include_once $className;
            return true;
        }

        echo 'File or class not exists';
        return false;
    }
}
