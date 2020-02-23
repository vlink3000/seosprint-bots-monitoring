<?php

namespace App\Domain\User\Entity;

class User
{
    /**
     * @var int|null
     */
    private $userId;
    /**
     * @var string|null
     */
    private $userName;
    /**
     * @var string|null
     */
    private $balance;
    /**
     * @var string
     */
    private $time;

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @param string|null $userName
     */
    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return string|null
     */
    public function getBalance(): ?string
    {
        return $this->balance;
    }

    /**
     * @param string|null $balance
     */
    public function setBalance(?string $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime(string $time): void
    {
        $this->time = $time;
    }
}