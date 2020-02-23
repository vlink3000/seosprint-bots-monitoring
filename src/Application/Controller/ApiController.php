<?php

namespace App\Application\Controller;

use App\Domain\Repository\BotRepositoryInterface;
use App\Domain\User\Factory\UserFactory;

class ApiController
{
    /** @var UserFactory */
    private $userFactory;

    /** @var BotRepositoryInterface */
    private $botRepository;

    /**
     * ApiController constructor.
     *
     * @param UserFactory $userFactory
     * @param BotRepositoryInterface $botRepository
     */
    public function __construct(
        UserFactory $userFactory,
        BotRepositoryInterface $botRepository
    ) {
        $this->userFactory = $userFactory;
        $this->botRepository = $botRepository;
    }

    /**
     * @param array $request
     *
     * @return void
     */
    public function processRequest(array $request): void
    {
        $user = $this->userFactory->createFromRequest($request);
        $this->botRepository->save($user);
    }
}