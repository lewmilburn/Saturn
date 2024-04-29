<?php

namespace Saturn\RouteManager;

use Saturn\HTTP\Router;

class RouteMain
{
    public Router $Router;

    public function __construct(Router $Router)
    {
        $this->Router = $Router;
    }

    public function Register(): void
    {
        if (WEBSITE_MODE == 1) {
            require_once __DIR__ . '/../../DefaultViews/Maintenance.php';
            exit;
        }
    }
}
