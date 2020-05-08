<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\BotRepositoryInterface;
use App\Domain\Bot\Entity\Bot;
use App\Infrastructure\Connector\DatabaseConnector;
use Carbon\Carbon;

class BotRepository implements BotRepositoryInterface
{
    private const TABLE_BOTS = 'bots';
    private const TABLE_LOGS = 'logs';
    private const TABLE_REQUESTS = 'requests';
    private const TABLE_REVENUE_REPORT = 'revenue_report';

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
            //log request, daily requests inside this table
            $requests= $eloquent->table(self::TABLE_REQUESTS)
                ->where('id', 1)
                ->pluck('requests')->first();
            $eloquent->table(self::TABLE_REQUESTS)->updateOrInsert(['id' => 1], [
                    'requests' => $requests+1,
                ]
            );
            $clicks = $eloquent->table(self::TABLE_BOTS)
                ->where('seosprint_id', $bot->getSeosprintId())
                ->pluck('clicks')->first();
            $dailyBalance = $eloquent->table(self::TABLE_BOTS)
                ->where('seosprint_id', $bot->getSeosprintId())
                ->pluck('daily_balance')->first();
            $eloquent->table(self::TABLE_BOTS)->updateOrInsert(['seosprint_id' => $bot->getSeosprintId()], [
                    'bot_name' => $bot->getBotName(),
                    'level' => $bot->getLevel(),
                    'clicks' => $bot->getClicked() ? $clicks+1: $clicks+0,
                    'balance' => $bot->getBalance(),
                    'daily_balance' => $bot->getDailyBalance() === 0 ? $dailyBalance: $dailyBalance + $bot->getDailyBalance(),
                    'time' => $bot->getDateTime()
                ]
            );
        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => Carbon::now()
            ]);
        }
    }

    /**
     * @return string
     */
    public function getMoneyToWithdraw(): string
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE_BOTS)
            ->where('balance', '>=', 15.00)
            ->sum('balance');

        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => Carbon::now()
            ]);

            return '';
        }
    }
    /**
     * @return void
     */
    public function saveDailyCurrency(): void
    {
        $eloquent = $this->databaseHandler->getConnection();


//        try {
//            $eloquent->table(self::TABLE_REVENUE_REPORT)->updateOrInsert(['id' => Carbon::today()->timestamp], [
//                    'requests' => $requests+1,
//                ]
//            );
//
//        } catch (\PDOException $exception) {
//            $eloquent->table(self::TABLE_LOGS)->insert([
//                'message' => $exception->getMessage(),
//                'time' => Carbon::now()
//            ]);
//        }
    }

    /**
     * @return array
     */
    public function getBots(): array
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE_BOTS)
                ->orderBy('balance', 'desc')
                ->get()
                ->toArray();
        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => Carbon::now()
            ]);

            return [];
        }
    }

    /**
     * @return string
     */
    public function getDailyRequests(): string
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE_REQUESTS)
                ->get();
        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => Carbon::now()
            ]);

            return '';
        }
    }

    /**
     * @return string
     */
    public function getDailyBalance(): string
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE_BOTS)
                ->sum('daily_balance');
        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => Carbon::now()
            ]);

            return '';
        }
    }

    /**
     * @return string
     */
    public function getBalance(): string
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE_BOTS)
                ->sum('balance');
        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => Carbon::now()
            ]);

            return '';
        }
    }

    /**
     * @return string
     */
    public function getDailyClicks(): string
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE_BOTS)
                ->sum('clicks');
        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => Carbon::now()
            ]);

            return '';
        }
    }

    /**
     * @return int
     */
    public function getBotsCount(): int
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE_BOTS)
                ->count();
        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => Carbon::now()
            ]);

            return '';
        }
    }

    /**
     * @return array
     */
    public function getLogs(): array
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE_LOGS)
                ->orderBy('time', 'desc')
                ->get()
                ->toArray();
        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => Carbon::now()
            ]);

            return [];
        }
    }

    /**
     * @return void
     */
    public function truncate(): void
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            $eloquent->table(self::TABLE_BOTS)->truncate();
            $eloquent->table(self::TABLE_LOGS)->truncate();
            $eloquent->table(self::TABLE_REQUESTS)->truncate();
        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => Carbon::now()
            ]);
        }
    }
}