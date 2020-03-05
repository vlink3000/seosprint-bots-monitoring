<?php

namespace App\Application\Helpers\Router;

use App\Application\Helpers\Router\Routes\ApiRoutes;
use App\Application\Helpers\Router\Routes\WebRoutes;

class RouteRecognizer
{
    public function recognizeRoute($uri): void
    {
        $webHandler = new WebRoutes();
        $apiHandler = new ApiRoutes();

        strpos($uri,'api/') == true ?
        $apiHandler->handleRoute($uri):
        $webHandler->handleRoute($uri);
    }
}