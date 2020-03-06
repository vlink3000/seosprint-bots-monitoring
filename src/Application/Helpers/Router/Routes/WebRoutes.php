<?php

namespace App\Application\Helpers\Router\Routes;

use App\Infrastructure\Handler\DatabaseHandler;
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
                echo $dashboardController->displayDashboard();
                break;
            case '/bots':
                echo $dashboardController->displayBotsList();
                break;
            default:
                echo $dashboardController->pageNotFound();
                break;
        }
    }

    private function setupController(): DashboardController
    {
        $databaseHandler = new DatabaseHandler();
        $botRepository = new BotRepository($databaseHandler);

        return new DashboardController($botRepository);
    }
}