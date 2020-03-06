<?php

namespace App\Application\Controller;

use App\Domain\Repository\BotRepositoryInterface;
use eftec\bladeone\BladeOne;
use Symfony\Component\HttpFoundation\Response;

class DashboardController
{
    /** @var BotRepositoryInterface */
    private $botRepository;

    /**
     * ApiController constructor.
     *
     * @param BotRepositoryInterface $botRepository
     */
    public function __construct(
        BotRepositoryInterface $botRepository
    ) {
        $this->botRepository = $botRepository;
    }

    /**
     * @return array
     */
    public function displayDashboard(): array
    {
        return $this->botRepository->displayDashboard();
    }

    /**
     * @return array
     */
    public function displayBotsList(): array
    {
        return $this->botRepository->displayDashboard();
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function pageNotFound(): string
    {
        $blade = $this->setupBlade();

        return $blade->run("404");
    }

    /**
     * @return BladeOne
     */
    private function setupBlade(): BladeOne
    {
        $views = 'public/views';
        $cache = 'cache';

        return new BladeOne($views, $cache,BladeOne::MODE_AUTO);
    }
}