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
     * @var string|null
     */
    private $level;
    /**
     * @var float|null
     */
    private $balance;
    /**
     * @var float|null
     */
    private $dailyBalance;
    /**
     * @var bool|null
     */
    private $clicked;
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
     * @return null|string
     */
    public function getLevel(): ?string
    {
        return $this->level;
    }

    /**
     * @param null|string $level
     */
    public function setLevel(?string $level): void
    {
        $this->level = $level;
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
     * @return float|null
     */
    public function getDailyBalance(): ?float
    {
        return $this->dailyBalance;
    }

    /**
     * @param float|null $dailyBalance
     */
    public function setDailyBalance(?float $dailyBalance): void
    {
        $this->dailyBalance = $dailyBalance;
    }

    /**
     * @return bool|null
     */
    public function getClicked(): ?bool
    {
        return $this->clicked;
    }

    /**
     * @param bool|null $clicked
     */
    public function setClicked(?bool $clicked): void
    {
        $this->clicked = $clicked;
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