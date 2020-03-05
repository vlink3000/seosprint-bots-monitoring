<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use App\Application\Helpers\Router\RouteRecognizer;

$autoload = require 'vendor/autoload.php';
$autoload->add('App\\', __DIR__ . '/src/');

$request = Request::createFromGlobals();

$routeRecognizer = new RouteRecognizer();
$routeRecognizer->recognizeRoute($request->getRequestUri());

//
//switch ($request->getPathInfo()) {
//    case '/':
//        $request->getContent();
//        break;
//    case '/about':
//        $response->setContent('This is the about page');
//        break;
//    default:
//        $response->setContent('Not found !');
//        $response->setStatusCode(Response::HTTP_NOT_FOUND);
//        $response->send();
//}


//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    $controller = new \App\Application\Controller\ApiController(
//        $userFactory,
//        $botRepository
//    );
//
//    $requestJson = file_get_contents('php://input');
//    $requestArr = json_decode($requestJson, TRUE);
//    $controller->processRequest($requestArr);
//
//} else {
//    $controller = new \App\Application\Controller\DashboardController(
//        $botRepository
//    );
//
//    $views = __DIR__ . '/public/views';
//    $cache = __DIR__ . '/cache';
//    $blade = new BladeOne($views,$cache,BladeOne::MODE_AUTO);
//
//    $users = $controller->displayDashboard();
//
//    try {
//        echo $blade->run("dashboard", array('users' => $users));
//    } catch (Exception $e) {
//        echo('something went wrong in blade package: ' . $e->getMessage());
//    }
//}