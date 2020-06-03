<?php

namespace App\Application\Controller;

use App\Domain\Bot\Factory\BotFactory;
use App\Domain\Payment\Factory\PaymentFactory;
use App\Domain\Task\Factory\TaskFactory;
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
     * @param Request $request
     *
     * @return \stdClass
     */
    public function updateTaskState(Request $request): \stdClass
    {
        $taskFactory = new TaskFactory();
        $databaseConnector = new DatabaseConnector();
        $botRepository = new BotRepository($databaseConnector);

        $task = $taskFactory->createFromRequest($request);

        return $botRepository->updateTaskState($task);
    }

    /**
     * @param Request $request
     *
     * @return void
     * @throws \Exception
     */
    public function payed(Request $request): void
    {
        $paymentFactory = new PaymentFactory();
        $databaseConnector = new DatabaseConnector();
        $botRepository = new BotRepository($databaseConnector);

        $payment = $paymentFactory->createFromRequest($request);
        $botRepository->payed($payment);
    }

    /**
     * @return void
     */
    public function createDailySnapshot(): void
    {
        $this->getRepository()->createSnapshot();
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