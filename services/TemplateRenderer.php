<?php
namespace app\services;

use app\base\App;
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
    public function render(string $template, array $params = []) : string
    {
        ob_start();
        extract($params);
        $templatePath
            = App::call()->config['templates_dir'] . $template . 'Tmpl.php';

        if (\file_exists($templatePath)) {
            include_once $templatePath;
        } else {
            throw new \Exception(
                sprintf('This %s file not exists', $templatePath)
            );
        }

        return ob_get_clean();
    }
}
