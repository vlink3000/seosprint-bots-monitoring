<?php

namespace App\Application\Controller;

use App\Application\Helpers\Validator\RequestValidator;
use App\Domain\Bot\Factory\BotFactory;
use App\Infrastructure\Connector\DatabaseConnector;
use App\Infrastructure\Repository\BotRepository;
use App\Infrastructure\Repository\NotifierRepository;
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
    public function saveDailyCurrency(): void
    {
        $this->getRepository()->saveDailyCurrency();
    }

    /**
     * @param Request $request
     *
     * @return void
     */
    public function triggerDispatch(Request $request): void
    {
        $validator = new RequestValidator();

        $this->getNotifierRepository()->triggerDispatch(
            $validator->validateRequestData($request)
        );
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

    /**
     * @return NotifierRepository
     */
    private function getNotifierRepository(): NotifierRepository
    {
        return new NotifierRepository();
    }
}