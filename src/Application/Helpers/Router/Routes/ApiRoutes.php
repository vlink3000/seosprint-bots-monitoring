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
                $apiController->save($request);
                break;
            case '/api/v1/truncate':
                $apiController->truncate();
                break;
            case '/api/v1/save/daily-currency':
                $apiController->saveDailyCurrency();
                break;
            case '/api/v1/dispatch':
                $apiController->triggerDispatch($request);
                break;
            default:
                break;
        }
    }
}