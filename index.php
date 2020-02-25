<?php

declare(strict_types=1);

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

    $users = $controller->displayDashboard();

    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">';
    echo '<table class="table table-dark table-striped>';
    echo '    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>';
    echo '<tbody>';
    foreach ($users as $user) {
        echo '<tr><td>'.$user->id.'</td></tr>';
    }
    echo '</tbody>';
    echo '</table>';
}