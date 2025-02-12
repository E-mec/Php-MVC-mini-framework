<?php

use App\Controllers\AuthController;
use App\Controllers\SiteController;
use App\Core\Application;

require_once __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DSN_DB'],
        'user' => $_ENV['DSN_USER'],
        'password' => $_ENV['DSN_PASSWORD'],
    ]
];

$app = new Application(__DIR__, $config);

$app->db->applyMigrations();

