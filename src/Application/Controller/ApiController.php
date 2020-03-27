<?php

namespace App\Application\Controller;

use App\Domain\Bot\Factory\BotFactory;
use App\Infrastructure\Connector\DatabaseConnector;
use App\Infrastructure\Repository\BotRepository;
use Symfony\Component\HttpFoundation\Request;

class ApiController
{
    /**
     * @param Request $request
     *
     * @return void
     */
    public function save(Request $request): void
    {
        $botFactory = new BotFactory();
        $databaseConnector = new DatabaseConnector();
        $botRepository = new BotRepository($databaseConnector);

        $bot = $botFactory->createFromRequest($request);
        $botRepository->save($bot);
    }

    /**
     * @return void
     */
    public function truncate(): void
    {
        $this->getRepository()->truncate();
    }

    /**
     * @return BotRepository
     */
    private function getRepository(): BotRepository
    {
        $databaseConnector = new DatabaseConnector();

        return new BotRepository($databaseConnector);
    }
}