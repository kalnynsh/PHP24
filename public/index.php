<?php

/** 
 * Learning PHP
 * 
 * PHP version 7.2
 * 
 * @category Learning_PHP
 * @package  Index
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
setlocale(LC_ALL, 'ru_RU.UTF-8', 'rus_RUS.UTF-8', 'Russian_Russia.UTF-8');

define('DS', DIRECTORY_SEPARATOR);
use \app\base\App;
use app\services\Autoloader;

require_once __DIR__ . '/../services/Autoloader.php';
require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register([new Autoloader(), 'loadClass']);

$config = include_once __DIR__ . '/../config/main.php';

App::call()->run($config);
