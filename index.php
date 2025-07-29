<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__.'/vendor/autoload.php';

$container = new Container();
$capsule = require __DIR__.'/config/database.php';
$container->set('db',$capsule);

AppFactory::setContainer($container);
$app = AppFactory::create();

require __DIR__.'/src/routes.php';

//$app->addBodyParsingMiddleware();  // Posso usar isso no lugar da função de $app->add();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->get('/user', function(Request $request, Response $response) {
    $data = [
        'usuario' => 'Vinicius',
        'email' => 'vinicius@gmail.com',
        'sexo' => 'masculino'
    ];
    
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
});

$app->run();