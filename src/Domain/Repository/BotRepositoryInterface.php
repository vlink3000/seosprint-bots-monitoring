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

    /***
     * @return array
     */
    public function getBots(): array;
}