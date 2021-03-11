<?php
use Slim\Http\Request; //namespace
use Slim\Http\Response;
use Slim\Views\PhpRenderer;

require __DIR__ . '/../vendor/autoload.php';

//Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

//Set up dependencies
require __DIR__ . '/../src/dependencies.php';

//Register routes
require __DIR__ . '/../src/routes.php';

//render homepage

$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("./templates");

$app->get('/', function (Request $request, Response $response){
    return $this->renderer->render($response, "/../public/index.phtml");
});

//Run app
$app->run();

?>
