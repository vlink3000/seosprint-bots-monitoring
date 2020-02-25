<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\BotRepositoryInterface;
use App\Domain\User\Entity\User;
use App\Infrastructure\Handler\DatabaseHandler;

class BotRepository implements BotRepositoryInterface
{
    private $databaseHandler;

    /**
     * BotRepository constructor.
     *
     * @param DatabaseHandler $databaseHandler
     */
    public function __construct(DatabaseHandler $databaseHandler)
    {
        $this->databaseHandler = $databaseHandler;
    }


    /**
     * @param User $user
     *
     * @return void
     */
    public function save(User $user): void
    {
        $eloquent = $this->databaseHandler->getConnection();

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

    /**
     * @return array
     */
    public function displayDashboard(): array
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table('users')->get()->toArray();
        } catch (\PDOException $exception) {
            $eloquent->table('logs')->insert([
                'message' => $exception->getMessage()
            ]);

            return [];
        }
    }
}