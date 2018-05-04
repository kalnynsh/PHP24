<?php

/** 
 * Learning PHP
 * 
 * PHP version 7.2
 * 
 * @category Learning_PHP
 * @package  Main_Page
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
setlocale(LC_ALL, 'ru_RU.UTF-8', 'rus_RUS.UTF-8', 'Russian_Russia.UTF-8');

require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/app.php';
require_once ROOT_DIR . '/services/Autoloader.php';
require_once VENDOR_DIR . '/autoload.php';
use app\services\Autoloader;
use app\services\TemplateRenderer;
use app\services\Request;

spl_autoload_register([new Autoloader(), 'loadClass']);

$request = new Request();

$controllerName = $request->getControllerName() ? : 'product';
$actionName = $request->getActionName();
$id = $request->getParams('id'); // 1

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    /** @var $controller */
    $controller = new $controllerClass(new TemplateRenderer());
    // Twig version
    // $controller = new $controllerClass(new TwigRenderer());
    $controller->runAction($actionName);
} else {
    echo sprintf('This %s controllerClass not exists', $controllerClass);
}
