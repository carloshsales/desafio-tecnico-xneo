<?php
require dirname(__DIR__) . '/core/routeConfig.php';
class Route extends RouteConfig
{
    public function initRoutes()
    {
        $routes = [
            "index" => [
                "path" => "/index",
                "action" => "index"
            ],
            "all" => [
                "path" => "/all",
                "action" => "getAll"
            ],
            "create" => [
                "path" => "/create",
                "action" => "create"
            ],
            "update" => [
                "path" => "/update",
                "action" => "update"
            ],
            "delete" => [
                "path" => "/delete",
                "action" => "delete"
            ],
            "check" => [
                "path" => "/check",
                "action" => "check"
            ]
        ];

        $this->setRoutes($routes);
    }
}
?>