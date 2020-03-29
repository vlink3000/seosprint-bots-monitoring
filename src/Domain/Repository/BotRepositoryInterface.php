<?php declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Bot\Entity\Bot;

interface BotRepositoryInterface
{
    /**
     * @param Bot $bot
     *
     * @return void
     */
    public function save(Bot $bot): void;

    /**
     * @return array
     */
    public function getBots(): array;

    /**
     * @return string
     */
    public function getDailyRequests(): string;

    /**
     * @return string
     */
    public function getDailyBalance(): string;

    /**
     * @return int
     */
    public function getBotsCount(): int;

    /**
     * @return string
     */
    public function getBalance(): string;

    /**
     * @return string
     */
    public function getDailyClicks(): string;

    /**
     * @return array
     */
    public function getLogs(): array;

    /**
     * @return void
     */
    public function truncate(): void;
}