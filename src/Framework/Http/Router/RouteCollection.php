<?php

namespace Framework\Http\Router;

class RouteCollection
{
    private $routes = [];

    public function getRoutes()
    {
        return $this->routes;
    }

    public function addRoutes(Route $route)
    {
        $this->routes[] = $route;
    }

    public function any($name, $pattern, $handler, array $tokens = [])
    {
        $this->addRoutes(new Route($name, $pattern, $handler, [], $tokens));
    }

    public function get($name, $pattern, $handler, array $tokens = [])
    {
        $this->addRoutes(new Route($name, $pattern, $handler, ['GET'], $tokens));
    }

    public function post($name, $pattern, $handler, array $tokens = [])
    {
        $this->addRoutes(new Route($name, $pattern, $handler, ['POST'], $tokens));
    }

    public function patch($name, $pattern, $handler, array $tokens = [])
    {
        $this->addRoutes(new Route($name, $pattern, $handler, ['POST'], $tokens));
    }

    public function delete($name, $pattern, $handler, array $tokens = [])
    {
        $this->addRoutes(new Route($name, $pattern, $handler, ['POST'], $tokens));
    }
}
