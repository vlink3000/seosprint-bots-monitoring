<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\BotRepositoryInterface;
use App\Domain\User\Entity\User;

class BotRepository implements BotRepositoryInterface
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function save(User $user): bool
    {
        // TODO: Implement store() method.
        var_dump('hi');die();
    }
}