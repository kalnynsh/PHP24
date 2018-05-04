<?php

namespace app\services;

use app\interfaces\IRenderer;

/**
 * Class render Twig templates
 */
class TwigRenderer implements IRenderer
{
    protected $templater;

    /**
     * Init Twig engine
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(ROOT_DIR . '/views/twig');
        $this->templater = new \Twig_Environment($loader);
    }

    /**
     * Render given template use Twig lib
     *
     * @param string $template - template's name
     * @param array  $params   - params passing to template
     * 
     * @return string - rendered template
     */
    public function render(string $template, array $params = []) : string
    {
        $template .= '.twig';

        return $this->templater->render($template, $params);
    }
}