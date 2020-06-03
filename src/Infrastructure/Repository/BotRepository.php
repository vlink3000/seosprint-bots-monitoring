<?php

namespace App\Infrastructure\Repository;

use App\Domain\Payment\Entity\Payment;
use App\Domain\Repository\BotRepositoryInterface;
use App\Domain\Bot\Entity\Bot;
use App\Domain\Task\Entity\Task;
use App\Infrastructure\Connector\DatabaseConnector;
use Carbon\Carbon;

class BotRepository implements BotRepositoryInterface
{
    private const TABLE_BOTS = 'bots';
    private const TABLE_TASKS = 'tasks';
    private const TABLE_PAYMENTS = 'payments';
    private const TABLE_LOGS = 'logs';
    private const TABLE_REQUESTS = 'requests';
    private const TABLE_SNAPSHOTS = 'snapshots';

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

            $eloquent->table(self::TABLE_BOTS)->updateOrInsert(['seosprint_id' => $bot->getSeosprintId()], [
                    'bot_name' => $bot->getBotName(),
                    'level' => $bot->getLevel(),
                    'balance' => $bot->getBalance(),
                    'last_request_at' => $bot->getLastRequestAt()
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
     * @param Task $task
     *
     * @return int
     */
    public function updateTaskState(Task $task): int
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            $eloquent->table(self::TABLE_TASKS)->updateOrInsert(['seosprint_id' => $task->getSeosprintId()], [
                    'task_id' => $task->getTaskId(),
                    'status' => $task->getStatus()
            ]);

            return $eloquent->table(self::TABLE_TASKS)
                ->where('seosprint_id', $task->getSeosprintId())
                ->pluck('status')->first();

        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => Carbon::now()
            ]);
        }
    }

    /**
     * @param Payment $payment
     *
     * @return void
     */
    public function payed(Payment $payment): void
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            $amount = $eloquent->table(self::TABLE_PAYMENTS)
                ->where('payeer_wallet', $payment->getPayeerWallet())
                ->pluck('amount')->first();

            $eloquent->table(self::TABLE_PAYMENTS)->updateOrInsert(['payeer_wallet' => $payment->getPayeerWallet()], [
                    'amount' => $amount + $payment->getAmount(),
                ]
            );

            $eloquent->table(self::TABLE_PAYMENTS)->updateOrInsert(['payeer_wallet' => $payment->getPayeerWallet()], [
                    'payeer_wallet' => $payment->getPayeerWallet(),
                    'amount' => $payment->getAmount() + $amount,
                    'updated_at' => $payment->getUpdatedAt()
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
            ->where('balance', '>=', 0.20)
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
     * @return array
     */
    public function getPayments(): array
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE_PAYMENTS)
                ->orderBy('updated_at', 'desc')
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
     * @return float
     */
    public function getSumOfPayments(): float
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE_PAYMENTS)
                ->sum('amount');
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
    public function getDailyRequests(): array
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE_REQUESTS)
                ->get()->toArray();
        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => Carbon::now()
            ]);

            return '';
        }
    }

    /**
     * @return float
     */
    public function getBalance(): float
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
     * @return float
     */
    public function getYesterdayBalance(): float
    {
        $eloquent = $this->databaseHandler->getConnection();

        try {
            return $eloquent->table(self::TABLE_SNAPSHOTS)
                ->whereDate('date', '=', Carbon::today()->format('Y-m-d'))
                ->pluck('balance')->first();
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
     * @return void
     */
    public function createSnapshot(): void
    {
        $eloquent = $this->databaseHandler->getConnection();

        $todayDate = Carbon::today()->format('Y-m-d');

        try {
            $eloquent->table(self::TABLE_SNAPSHOTS)->updateOrInsert(['date' => $todayDate], [
                    'balance' => $this->getBalance(),
                    'balance_to_withdraw' => $this->getMoneyToWithdraw(),
                    'bots_count' => count($this->getBots()),
                    'requests' => $this->getDailyRequests()[0]->requests,
                    'date' => $todayDate
                ]
            );
        } catch (\PDOException $exception) {
            $eloquent->table(self::TABLE_LOGS)->insert([
                'message' => $exception->getMessage(),
                'time' => $todayDate
            ]);
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