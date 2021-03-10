<?php

use Slim\Http\Request; //namespace
use Slim\Http\Response;
use Slim\Views\PhpRenderer;

$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("./templates");

$app->get('/request', function (Request $request, Response $response){
    return $this->renderer->render($response, "/request.phtml");
});


?>
