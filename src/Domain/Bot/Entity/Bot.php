<?php

namespace App\Domain\Bot\Entity;

use Carbon\Carbon;

class Bot
{
    /**
     * @var string|null
     */
    private $seosprintId;
    /**
     * @var string|null
     */
    private $botName;
    /**
     * @var float|null
     */
    private $balance;
    /**
     * @var Carbon
     */
    private $dateTime;

    /**
     * @return null|string
     */
    public function getSeosprintId(): ?string
    {
        return $this->seosprintId;
    }

    /**
     * @param null|string $seosprintId
     */
    public function setSeosprintId(?string $seosprintId): void
    {
        $this->seosprintId = $seosprintId;
    }

    /**
     * @return null|string
     */
    public function getBotName(): ?string
    {
        return $this->botName;
    }

    /**
     * @param null|string $botName
     */
    public function setBotName(?string $botName): void
    {
        $this->botName = $botName;
    }

    /**
     * @return float|null
     */
    public function getBalance(): ?float
    {
        return $this->balance;
    }

    /**
     * @param float|null $balance
     */
    public function setBalance(?float $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return Carbon
     */
    public function getDateTime(): Carbon
    {
        return $this->dateTime;
    }

    /**
     * @param Carbon $dateTime
     */
    public function setDateTime(Carbon $dateTime): void
    {
        $this->dateTime = $dateTime;
    }
}