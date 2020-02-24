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
     * @return void
     */
    public function save(User $user): void
    {
        $databaseHandler = new DatabaseHandler();
        $eloquent = $databaseHandler->getConnection();

        try {
            $eloquent->table('users')->updateOrInsert(['seosprint_id' => $user->getSeosprintId()],
                [
                    'user_name' => $user->getUserName(),
                    'balance' => $user->getBalance(),
                    'time' => $user->getDateTime()
                ]
            );
        } catch (\PDOException $exception) {
            $eloquent->table('logs')->insert([
                'message' => $exception->getMessage()
            ]);
        }
    }
}