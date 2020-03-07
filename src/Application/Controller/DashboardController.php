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
        $this->setupBlade()->setMode(1);
        return $this->setupBlade()->run("dashboard", [
            'bots' => $this->botRepository->getBots()
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
            self::CACHE_PATH,
            BladeOne::MODE_AUTO
        );
    }
}