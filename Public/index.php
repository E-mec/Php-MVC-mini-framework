<?php

use App\Core\Application;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Application();

$app->router->get('/', function(){
    echo "Welcome world!";
});

$app->router->get('/contacts', function(){
    echo "Contact Us!";
});

$app->run();