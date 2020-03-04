<?php

namespace App\Application\Controller;

use App\Domain\User\Factory\UserFactory;
use App\Infrastructure\Handler\DatabaseHandler;
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
        $userFactory = new UserFactory();
        $databaseHandler = new DatabaseHandler();
        $botRepository = new BotRepository($databaseHandler);

        $user = $userFactory->createFromRequest($request);
        $botRepository->save($user);
    }
}