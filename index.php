<?php

session_start();

define('BASE_PATH', getcwd());
define('SCRIPT_ROOT', 'http://localhost:8080');

require __DIR__ . '/vendor/autoload.php';

use Framework\Application;

$application = new Application();
$application->start();