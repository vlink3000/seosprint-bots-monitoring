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
     * @return array
     */
    public function getDailyRequests(): array;

    /**
     * @return string
     */
    public function getMoneyToWithdraw(): string;

    /**
     * @return int
     */
    public function getBotsCount(): int;

    /**
     * @return float
     */
    public function getBalance(): float;

    /**
     * @return float
     */
    public function getYesterdayBalance(): float;

    /**
     * @return array
     */
    public function getLogs(): array;

    /**
     * @return void
     */
    public function truncate(): void;
}