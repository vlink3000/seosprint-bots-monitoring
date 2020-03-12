<?php

namespace App\Application\Helpers\Router\Routes;

use App\Infrastructure\Connector\DatabaseConnector;
use Symfony\Component\HttpFoundation\Request;
use App\Infrastructure\Repository\BotRepository;
use App\Application\Controller\DashboardController;

class WebRoutes
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function handleRoute(Request $request)
    {
        $dashboardController = $this->setupController();

        switch ($request->getPathInfo()) {
            case '/':
                echo $dashboardController->displayBotsDashboard();
                break;
            case '/logs':
                echo $dashboardController->displayLogsDashboard();
                break;
            default:
                echo $dashboardController->pageNotFound();
                break;
        }
    }

    /**
     * @return DashboardController
     */
    private function setupController(): DashboardController
    {
        $databaseConnector = new DatabaseConnector();
        $botRepository = new BotRepository($databaseConnector);

        return new DashboardController($botRepository);
    }
}