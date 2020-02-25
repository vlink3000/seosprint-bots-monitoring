<?php

namespace App\Application\Controller;

use App\Domain\Repository\BotRepositoryInterface;

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
}