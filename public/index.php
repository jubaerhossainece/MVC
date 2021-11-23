<?php

    require_once __DIR__.'/../vendor/autoload.php';

    use App\Application;

    $root = __DIR__;
    
    $app = new Application($root);
    $app->router->get('/','home');

    $app->router->get('/contact', 'contact');

    $app->run();
?>