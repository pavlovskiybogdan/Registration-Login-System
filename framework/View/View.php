<?php

declare(strict_types=1);

namespace Framework\View;

use Framework\Application;

/**
 * Class View
 * @package Framework\View
 */
class View
{
    /**
     * Current view file
     */
    public string $currentView;

    /**
     * View file variables
     */
    public array $viewVars = [];

    /**
     * Render layout and requested file
     * @param string $filename
     * @param array $args
     * @return mixed
     */
    public static function make(string $filename, array $args = [])
    {
        $self = new static();

        $self->currentView = $filename;
        $self->viewVars = $args;

        return include('app/views/layouts/main.php');
    }

    /**
     * Render content
     * @return mixed|string
     */
    public function content()
    {
        if ($this->currentView) {
            return $this->includeFile($this->currentView);
        }

        return '';
    }

    /**
     * @return mixed
     */
    public static function render404()
    {
        return (new static())->includeFile('default/404');
    }

    /**
     * Returns main css file path
     * @return string
     */
    public function cssPath(): string
    {
        return Application::$app->request->fullHost . '/app/assets/css/app.css';
    }

    /**
     * Returns main js file path
     * @return string
     */
    public function jsPath(): string
    {
        return Application::$app->request->fullHost . '/app/assets/js/dist/app.js';
    }

    /**
     * Including a view file
     * @param string $filename
     * @return mixed
     */
    private function includeFile(string $filename)
    {
        extract($this->viewVars, EXTR_PREFIX_SAME, 'wddx');

        return include('app/views/' . $filename . '.php');
    }
}
