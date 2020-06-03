<?php declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use App\Application\Helpers\Router\RouteRecognizer;

$autoload = require 'vendor/autoload.php';
$autoload->add('App\\', __DIR__ . '/src/');

$request = Request::createFromGlobals();

$routeRecognizer = new RouteRecognizer();
$routeRecognizer->recognizeRoute($request);