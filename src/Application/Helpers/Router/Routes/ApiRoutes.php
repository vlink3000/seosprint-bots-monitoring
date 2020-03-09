<?php

namespace App\Application\Helpers\Router\Routes;

use App\Application\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;

class ApiRoutes
{
    public function handleRoute(Request $request)
    {
        $apiController = new ApiController();

        switch ($request->getPathInfo()) {
            case '/api/v1/save':
                $apiController->processRequest($request);
                break;
            default:
                break;
        }
    }
}