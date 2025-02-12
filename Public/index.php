<?php

use App\Controllers\AuthController;
use App\Controllers\SiteController;
use App\Core\Application;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DSN_DB'],
        'user' => $_ENV['DSN_USER'],
        'password' => $_ENV['DSN_PASSWORD'],
    ]
];


$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/contacts', [SiteController::class, 'contact']);
$app->router->post('/contacts', [SiteController::class, 'handleContact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);


$app->run();