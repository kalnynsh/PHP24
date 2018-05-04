<?php
namespace app\services;

use app\interfaces\IRenderer;

/**
 * Class for render `classic` php sintax templates
 */
class TemplateRenderer implements IRenderer
{
    /**
     * Render given template use ob_*
     *
     * @param string $template - template's name
     * @param array  $params   - params passing to template
     * 
     * @return string - rendered template
     */
    public function renderTemplate(string $template, array $params = []) : string
    {
        ob_start();
        extract($params);
        $templatePath = TEMPLATES_DIR . '/' . $template . 'Tmpl.php';
        include_once $templatePath;

        return ob_get_clean();
    }
}