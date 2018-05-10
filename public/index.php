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

require_once __DIR__ . '/../services/Autoloader.php';
require_once __DIR__ . '/../vendor/autoloader.php';

spl_autoload_register([new Autoloader(), 'loadClass']);

$config = include_once __DIR__ . '/../config/main.php';

App::call()->run($config);


/*
use app\services\Autoloader;
use app\services\TemplateRenderer;
use app\services\Request;

require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/app.php';
require_once ROOT_DIR . '/services/Autoloader.php';
require_once VENDOR_DIR . '/autoload.php';

$request = new Request();
$controllerName = $request->getControllerName() ? : 'product';
$actionName = $request->getActionName();
$id = $request->getParams('id'); // 1
$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {   
    $controller = new $controllerClass(new TemplateRenderer());
    // Twig version
    // $controller = new $controllerClass(new TwigRenderer());
    $controller->runAction($actionName);
} else {
    echo sprintf('This %s controllerClass not exists', $controllerClass);
}
 */

