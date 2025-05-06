<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Random\Controller\RandomController;

$container = require dirname(__DIR__) . '/config/services.php';
$request = Request::createFromGlobals();

/** @var RandomController $controller */
$controller = $container->get(RandomController::class);
$response = $controller->handle($request);

$response->send();
