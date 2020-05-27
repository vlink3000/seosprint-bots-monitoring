<?php

namespace App\Application\Controller;

use App\Domain\Repository\BotRepositoryInterface;
use eftec\bladeone\BladeOne;

class DashboardController
{
    private const VIEWS_PATH = "public/views";
    private const CACHE_PATH = "public/cache";

    /** @var BotRepositoryInterface */
    private $botRepository;

    /**
     * ApiController constructor.
     *
     * @param BotRepositoryInterface $botRepository
     */
    public function __construct(BotRepositoryInterface $botRepository)
    {
        $this->botRepository = $botRepository;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function displayBotsDashboard(): string
    {
        //i know, it is huge... but does not matter, it is POC!
        $bots = $this->botRepository->getBots();
        $payments = $this->botRepository->getPayments();
        $moneyToWithdraw = round($this->botRepository->getMoneyToWithdraw(), 4);
        $totalCurrency = json_decode(round($this->botRepository->getBalance(), 4));
        $botsCount = $this->botRepository->getBotsCount();
        $requests = $this->botRepository->getDailyRequests()[0]->requests;
        $requestsPerBot = round($requests / $botsCount, 0);
        $sumOfPayments = round($this->botRepository->getSumOfPayments(), 2);

        return $this->setupBlade()->run("dashboard.main", [
            'bots' => $bots,
            'payments' => $payments,
            'money_to_withdraw' => $moneyToWithdraw,
            'real_money' => $sumOfPayments,
            'total_currency' => $totalCurrency,
            'requests' => $requests,
            'requests_per_bot' => $requestsPerBot
        ]);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function displayLogsDashboard(): string
    {
        return $this->setupBlade()->run("logs", [
            'logs' => $this->botRepository->getLogs()
        ]);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function pageNotFound(): string
    {
        return $this->setupBlade()->run("404");
    }

    /**
     * @return BladeOne
     */
    private function setupBlade(): BladeOne
    {
        return new BladeOne(
            self::VIEWS_PATH,
            self::CACHE_PATH
        );
    }
}