<?php

session_start();

define('BASE_PATH', getcwd());

require __DIR__ . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$application = new \Framework\Application();
$application->start();
