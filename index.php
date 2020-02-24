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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $requestJson = file_get_contents('php://input');
    $requestArr = json_decode($requestJson, TRUE);
    $controller->processRequest($requestArr);

} else {
    echo json_encode([
        'status' => 'up'
    ]);
}