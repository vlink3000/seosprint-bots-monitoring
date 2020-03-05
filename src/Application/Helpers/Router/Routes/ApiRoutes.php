<?php

namespace App\Application\Helpers\Router\Routes;

class ApiRoutes
{
    public function handleRoute(string $uri)
    {
        echo('api');
        echo $uri;
    }
}