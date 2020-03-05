<?php

namespace App\Application\Helpers\Router\Routes;

class WebRoutes
{
    public function handleRoute(string $uri)
    {
        echo('web');
        echo $uri;
    }
}