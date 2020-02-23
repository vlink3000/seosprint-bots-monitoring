<?php

declare(strict_types=1);

$autoload = require 'vendor/autoload.php';
$autoload->add('App\\', __DIR__ . '/src/');

$userFactory = new \App\Domain\User\Factory\UserFactory();
$botRepository = new \App\Infrastructure\Repository\BotRepository();

$controller = new \App\Application\Controller\ApiController(
    $userFactory,
    $botRepository
);

$controller->processRequest([
    'userId' => 1234,
    'userName' => 'Test',
    'balance' => '12.80'
]);