<?php

namespace Framework\Routing;

/**
 * Class Router
 * @package Framework\Routing
 */
class Router
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * @param string $route
     * @param string $controller
     * @param string $method
     */
    public function addRoute(string $route, string $controller, string $method) : void
    {
        $this->routes[] = [
          'path' => $route,
          'controller' => $controller,
          'method' => $method
        ];
    }

    /**
     * @return string|void
     */
    public static function startRouting()
    {
        /** @var self $self */
        $self = require 'app/routes/routes.php';

        foreach ($self->routes as $route) {
            if ($route['path'] === $_SERVER['REQUEST_URI'] || $self->isChangePasswordRoute($route['path'])) {
                return (new static())->findAction($route);
            }
        }

        return header('Location: /register');
    }

    /**
     * @param string $path
     * @return bool
     */
    private function isChangePasswordRoute(string $path): bool
    {
        return preg_match('/\/change-password\/[0-9a-f]{15}/', $_SERVER['REQUEST_URI'])
            && $path === 'change-password';
    }

    /**
     * @param array $route
     * @return string
     */
    private function findAction(array $route)
    {
        try {
            $namespace = '\App\src\Controllers\\' . $route['controller'];
            $controller = new $namespace;
            $method = $route['method'];
            return $controller->$method();
        } catch (\Throwable $t) {
            return $t->getMessage();
        }
    }
}