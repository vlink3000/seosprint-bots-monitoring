<?php

namespace App\Domain\Payment\Entity;

use Carbon\Carbon;

class Payment
{
    /**
     * @var string
     */
    private $payeerWallet;
    /**
     * @var float
     */
    private $amount;

    /**
     * @var Carbon
     */
    private $updatedAt;

    /**
     * @return string
     */
    public function getPayeerWallet(): string
    {
        return $this->payeerWallet;
    }

    /**
     * @param string $payeerWallet
     */
    public function setPayeerWallet(string $payeerWallet): void
    {
        $this->payeerWallet = $payeerWallet;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    /**
     * @param Carbon $updatedAt
     */
    public function setUpdatedAt(Carbon $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}