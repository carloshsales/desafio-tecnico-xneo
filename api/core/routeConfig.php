<?php
require dirname(__DIR__) . '/controller/controller.php';
abstract class RouteConfig
{
    private array $routes;

    function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    abstract public function initRoutes();

    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    public function run($url)
    {
        $excludedUrls = array(
            '/index',
            '/all',
            '/create',
            '/update',
            '/delete',
            '/check'
        );

        if (!in_array($url, $excludedUrls)) {
            $url = '/index';
        }

        $controller = new Controller();

        foreach ($this->routes as $routes => $route) {
            if ($url === $route['path']) {
                if (preg_match('/^\/update\/(\d+)$/', $url, $matches) && ($route['path'] === '/update' || $route['path'] === 'delete' || $route['path'] === 'check')) {
                    $id = $matches[1];
                    $controller->{$route['action']}($id);
                }
                $controller->{$route['action']}();
            }
        }
    }

    public function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
?>