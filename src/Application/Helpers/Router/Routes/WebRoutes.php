<?php

namespace App\Application\Helpers\Router\Routes;

use App\Infrastructure\Connector\DatabaseConnector;
use Symfony\Component\HttpFoundation\Request;
use App\Infrastructure\Repository\BotRepository;
use App\Application\Controller\DashboardController;

class WebRoutes
{
    public function handleRoute(Request $request)
    {
        $dashboardController = $this->setupController();

        switch ($request->getPathInfo()) {
            case '/':
                echo $dashboardController->displayBotsDashboard();
                break;
            default:
                echo $dashboardController->pageNotFound();
                break;
        }
    }

    private function setupController(): DashboardController
    {
        $databaseConnector = new DatabaseConnector();
        $botRepository = new BotRepository($databaseConnector);

        return new DashboardController($botRepository);
    }
}