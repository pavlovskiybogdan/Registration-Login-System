<?php

namespace Framework;

use Framework\Routing\Router;
use Framework\Localization\Localization;
use Framework\Helpers\Request;
use Framework\Helpers\Mailer;

/**
 * Class Application
 * @package Framework
 */
class Application
{
    /**
     * Dependencies container
     */
    public static \stdClass $app;

    public function __construct()
    {
        self::$app = new \stdClass();
        $this->setDependencies();
    }

    /**
     * Start the application
     */
    public function start() : void
    {
        $localization = new Localization();
        $localization->localize();

        self::$app->localization = $localization;

        Router::startRouting();
    }

    /**
     * Set default dependencies
     */
    public function setDependencies()
    {
        self::$app->request = new Request();
        self::$app->mailer = new Mailer();
    }
}