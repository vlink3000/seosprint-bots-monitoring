<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\BotRepositoryInterface;
use App\Domain\User\Entity\User;
use App\Infrastructure\Handler\DatabaseHandler;

class BotRepository implements BotRepositoryInterface
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function save(User $user): bool
    {
        $userId = $user->getUserId();
        $userName = $user->getUserName();
        $balance = $user->getBalance();
        $time = $user->getTime();

        $databaseHandler = new DatabaseHandler();

        $databaseHandler->getConnection();

//        var_dump($time);die();
    }
}