<?php declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\User\Entity\User;

interface BotRepositoryInterface
{
    /**
     * @param User $user
     *
     * @return void
     */
    public function save(User $user): void;
}