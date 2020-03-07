<?php

namespace App\Application\Controller;

use App\Domain\Bot\Factory\BotFactory;
use App\Infrastructure\Connector\DatabaseConnector;
use App\Infrastructure\Repository\BotRepository;

class ApiController
{
    /**
     * @param array $request
     *
     * @return void
     */
    public function processRequest(array $request): void
    {
        $userFactory = new BotFactory();
        $databaseConnector = new DatabaseConnector();
        $botRepository = new BotRepository($databaseConnector);

        $bot = $userFactory->createFromRequest($request);
        $botRepository->save($bot);
    }
}