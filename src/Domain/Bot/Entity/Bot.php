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
     * @var string|null
     */
    private $level;
    /**
     * @var Carbon
     */
    private $lastRequestAt;
    /**
     * @var string
     */
    private $lastClickedAt;

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
     * @return Carbon
     */
    public function getLastRequestAt(): Carbon
    {
        return $this->lastRequestAt;
    }

    /**
     * @param Carbon $lastRequestAt
     */
    public function setLastRequestAt(Carbon $lastRequestAt): void
    {
        $this->lastRequestAt = $lastRequestAt;
    }

    /**
     * @return string
     */
    public function getLastClickedAt(): string
    {
        return $this->lastClickedAt;
    }

    /**
     * @param string $lastClickedAt
     */
    public function setLastClickedAt(string $lastClickedAt): void
    {
        $this->lastClickedAt = $lastClickedAt;
    }
}