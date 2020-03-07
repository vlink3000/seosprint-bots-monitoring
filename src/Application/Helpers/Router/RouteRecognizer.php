<?php

namespace App\Application\Helpers\Router;

use App\Application\Helpers\Router\Routes\ApiRoutes;
use App\Application\Helpers\Router\Routes\WebRoutes;
use Symfony\Component\HttpFoundation\Request;

class RouteRecognizer
{
    public function recognizeRoute(Request $request): void
    {
        if (strpos($request->getRequestUri(),'api/') === false) {
            $webHandler = new WebRoutes();
            $webHandler->handleRoute($request);
        } else {
            $apiHandler = new ApiRoutes();
            $apiHandler->handleRoute($request);
        }
    }
}