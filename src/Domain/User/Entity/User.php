<?php

namespace App\Domain\User\Entity;

use Carbon\Carbon;

class User
{
    /**
     * @var string|null
     */
    private $seosprintId;
    /**
     * @var string|null
     */
    private $userName;
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
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @param null|string $userName
     */
    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
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