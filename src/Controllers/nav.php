<?php

use Slim\Http\Request; //namespace
use Slim\Http\Response;
use Slim\Views\PhpRenderer;

$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("./templates");

$app->get('/request', function (Request $request, Response $response){
    return $this->renderer->render($response, "/../public/request.phtml");
});

$app->get('/login', function (Request $request, Response $response){
    return $this->renderer->render($response, "/../public/login.phtml");
})->setName('route.login');

$app->get('/adminpage', function (Request $request, Response $response){
    return $this->renderer->render($response, "/../public/adminpage.phtml");
})->setName('route.admin');
?>
