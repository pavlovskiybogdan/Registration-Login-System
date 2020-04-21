<?php

namespace Framework\View;

class View
{
    /**
     * Current view file
     * @var string
     */
    public $currentView;

    /**
     * View variables
     * @var array
     */
    public $vars = [];

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
        $self->vars = $args;

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
    public function cssPath() : string
    {
        return SCRIPT_ROOT . '/app/assets/css/app.css';
    }

    /**
     * Returns main js file path
     * @return string
     */
    public function jsPath() : string
    {
        return SCRIPT_ROOT . '/app/assets/js/prod/app.js';
    }

    /**
     * Including a view file
     * @param $filename
     * @return mixed
     */
    private function includeFile($filename)
    {
        extract($this->vars, EXTR_PREFIX_SAME, 'wddx');

        return include('app/views/' . $filename . '.php');
    }
}