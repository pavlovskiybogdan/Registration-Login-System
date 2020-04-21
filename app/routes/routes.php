<?php

use Framework\Routing\Router;

$router = new Router();

$router->addRoute('/register', 'HomeController', 'renderRegisterPage');
$router->addRoute('/login', 'HomeController', 'renderLoginPage');
$router->addRoute('/profile', 'HomeController', 'renderProfilePage');
$router->addRoute('/reset-password', 'HomeController', 'renderResetPasswordPage');
$router->addRoute('change-password', 'HomeController', 'renderChangePasswordPage');

$router->addRoute('/reset-password-action', 'Auth\AuthController', 'actionChangePassword');
$router->addRoute('/register-action', 'Auth\AuthController', 'actionRegister');
$router->addRoute('/login-action', 'Auth\AuthController', 'actionLogin');
$router->addRoute('/send-link-action', 'Auth\AuthController', 'actionSendResetLink');
$router->addRoute('/check-user-email', 'Auth\AuthController', 'getUserEmail');
$router->addRoute('/logout', 'Auth\AuthController', 'actionLogout');

$router->addRoute('/change-language', 'HomeController', 'changeLanguage');

return $router;