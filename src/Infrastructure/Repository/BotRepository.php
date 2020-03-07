<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\BotRepositoryInterface;
use App\Domain\Bot\Entity\Bot;
use App\Infrastructure\Connector\DatabaseConnector;

class BotRepository implements BotRepositoryInterface
{
    private const TABLE = 'bots';

    private $databaseHandler;

    /**
     * BotRepository constructor.
     *
     * @param DatabaseConnector $databaseHandler
     */
    public function __construct(DatabaseConnector $databaseHandler)
    {
        $this->databaseHandler = $databaseHandler;
    }

    /**
     * @param Bot $bot
     *
     * @return void
     */
    public function save(Bot $bot): void
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            $eloquent->table(self::TABLE)->updateOrInsert(['seosprint_id' => $bot->getSeosprintId()],
                [
                    'bot_name' => $bot->getUserName(),
                    'balance' => $bot->getBalance(),
                    'time' => $bot->getDateTime()
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
    public function getBots(): array
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE)->get()->toArray();
        } catch (\PDOException $exception) {
            $eloquent->table('logs')->insert([
                'message' => $exception->getMessage()
            ]);

            return [];
        }
    }
}