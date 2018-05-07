<?php

/** 
 * PHP Controller
 * 
 * PHP version 7.2
 * 
 * @category Controllers
 * @package  Controller_Abstract_Class
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */

namespace app\controllers;

use app\interfaces\IRenderer;

/**
 * Controller abstract class
 */
abstract class Controller
{
    protected $action;
    protected $defaultAction = 'index';
    protected $layout = 'master';
    protected $useLayout = true;
    protected $renderEngine;

    /**
     * Init property $renderer setting to passing 
     * IRenderer $render
     *
     * @param IRenderer $renderEngine - Engine for rendering
     */
    public function __construct(IRenderer $renderEngine)
    {
        $this->renderEngine = $renderEngine;
    }

    /**
     * Run given action
     *
     * @param string $action - action's name
     * 
     * @return void
     */
    public function runAction(string $action = null)
    {
        $this->action = $action ? : $this->defaultAction;
        $method = 'action' . ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            header('HTTP/1.1 404 Not Found');
            die('Error 404 Not Found');
        }
    }

    /**
     * Render template use or not $layout
     *
     * @param string $template - template's name
     * @param array  $params   - params passing to template
     * 
     * @return void
     */
    public function render(string $template, array $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate(
                "/layouts/{$this->layout}",
                [
                    'content' => $this->renderTemplate($template, $params),
                ]
            );
        } else {
            $this->renderTemplate($template, $params);
        }
    }

    /**
     * Render given template use ob_*
     *
     * @param string $template - template's name
     * @param array  $params   - params passing to template
     * 
     * @return string
     */
    public function renderTemplate(string $template, array $params = []) : string
    {
        return $this->renderEngine->render($template, $params);
    }

    /**
     * Redirect to given URL
     *
     * @param string $url - URL
     * 
     * @return void
     */
    protected function redirect(string $url)
    {
        return header('Location: ' . $url);
    }
} 
