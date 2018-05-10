<?php

/** 
 * Learning PHP
 * 
 * PHP version 7.2
 * 
 * @category Learning_PHP
 * @package  PHP_Config
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */

/**
 * Define constant the Path to Document Root
 */
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/..');

/**
 * Define constant the Path to public/
 */
define('PUBLIC_DIR', ROOT_DIR . '/public');

/**
 * Define constant the Path to uploads/
 */
define('UPLOADS_DIR', ROOT_DIR . '/uploads');

/**
 * Define constant the Path to /views/layouts
 */
define('LAYOUTS_DIR', ROOT_DIR . '/views/layouts');

/**
 * Define constant the Path to /views
 */
define('TEMPLATES_DIR', ROOT_DIR . '/views');

/**
 * Define constant the Path to /vendor
 */
define('VENDOR_DIR', ROOT_DIR . '/vendor');

/**
 * Define constant of Controllers name space
 */
define('CONTROLLERS_NAMESPACE', 'app\controllers\\');
