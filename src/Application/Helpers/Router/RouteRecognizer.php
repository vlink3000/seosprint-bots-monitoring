<?php

namespace App\Application\Helpers\Router;

use App\Application\Helpers\Router\Routes\ApiRoutes;
use App\Application\Helpers\Router\Routes\WebRoutes;
use Symfony\Component\HttpFoundation\Request;

class RouteRecognizer
{
    public function recognizeRoute(Request $request): void
    {
        $webHandler = new WebRoutes();
        $apiHandler = new ApiRoutes();

        strpos($request->getRequestUri(),'api/') == true ?
        $apiHandler->handleRoute($request):
        $webHandler->handleRoute($request);
    }
}