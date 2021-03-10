<?php

use Slim\Http\Request; //namespace
use Slim\Http\Response;

//read value
$app->get('/hello/{name}', function (Request $request, Response $response, array $arg){
    $name = $arg['name'];
    $response->getBody() -> write ("Hello world, $name");
    return true; //$response;
});


?>
