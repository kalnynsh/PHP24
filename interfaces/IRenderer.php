<?php

namespace app\interfaces;

/**
 * Interfaces for Renderers
 */
interface IRenderer
{
    /**
     * Method for render passing $template with $params
     */
    public function render(string $template, array $params = []) : string;
}
