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

/**
 * Controller abstract class
 */
abstract class Controller
{
    private $_action;
    private $_defaultAction = 'index';
    private $_layout = 'master';
    private $_useLayout = true;

    /**
     * Run given action
     *
     * @param string $action - action's name
     * 
     * @return void
     */
    public function runAction(string $action = null)
    {
        $this->_action = $action ?? $this->_defaultAction;
        $method = 'action' . ucfirst($this->_action);

        // var_dump($action, $method);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            header('HTTP/1.1 404 Not Found');
            die('Error 404 Not Found');
        }
    }

    /**
     * Render template use or not $_layout
     *
     * @param string $template - template's name
     * @param array  $params   - params passing to template
     * 
     * @return void
     */
    public function render(string $template, array $params = [])
    {
        if ($this->_useLayout) {
            return $this->renderTemplate(
                "/layouts/{$this->_layout}",
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
     * @return void
     */
    public function renderTemplate(string $template, array $params = [])
    {
        ob_start();
        extract($params);
        $templatePath = TEMPLATES_DIR . '/' . $template . 'Tmpl.php';
        include_once $templatePath;

        return ob_get_clean();
    }

} 