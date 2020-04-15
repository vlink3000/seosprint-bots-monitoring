<?php declare(strict_types=1);

namespace App\Domain\Repository;

interface NotifierRepositoryInterface
{
    /**
     * @param array $requestData
     *
     * @return void
     */
    public function triggerDispatch(array $requestData): void;
}