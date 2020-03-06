<?php

namespace App\Application\Helpers\Router\Routes;

use Symfony\Component\HttpFoundation\Request;

class ApiRoutes
{
    public function handleRoute(Request $request)
    {
        echo('api');
    }
}