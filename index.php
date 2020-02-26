<?php

declare(strict_types=1);

use eftec\bladeone\BladeOne;

$autoload = require 'vendor/autoload.php';
$autoload->add('App\\', __DIR__ . '/src/');

$databaseHandler = new \App\Infrastructure\Handler\DatabaseHandler();
$userFactory = new \App\Domain\User\Factory\UserFactory();
$botRepository = new \App\Infrastructure\Repository\BotRepository($databaseHandler);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new \App\Application\Controller\ApiController(
        $userFactory,
        $botRepository
    );

    $requestJson = file_get_contents('php://input');
    $requestArr = json_decode($requestJson, TRUE);
    $controller->processRequest($requestArr);

} else {
    $controller = new \App\Application\Controller\DashboardController(
        $botRepository
    );

    $views = __DIR__ . '/public/views';
    $cache = __DIR__ . '/cache';
    $blade = new BladeOne($views,$cache,BladeOne::MODE_AUTO);

    $users = $controller->displayDashboard();

    try {
        echo $blade->run("dashboard", array('users' => $users));
    } catch (Exception $e) {
        echo('something went wrong in blade package: ' . $e->getMessage());
    }
}