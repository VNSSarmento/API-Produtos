<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;


require __DIR__.'/vendor/autoload.php';
$capsule = require __DIR__.'/config/database.php';

$container = new Container();
$container->set('db',$capsule);
AppFactory::setContainer($container);


$app = AppFactory::create();

require __DIR__.'/src/routes.php';

$app->addBodyParsingMiddleware();  // Posso usar isso no lugar da função de $app->add();
/* $app->add(function(Request $request, RequestHandler $handler): Response {
    $auth = $request->getHeaderLine('autorizado');

    if ($auth !== 'sim') {
        $response = new SlimResponse(); Nesse caso precisa colocar "use Slim\Psr7\Response as SlimResponse;" la em cima
        $response->getBody()->write('Acesso não autorizado');
        return $response->withStatus(401);
    }

    return $handler->handle($request); */

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true); 

$container->get('db');//isso aqui faz a conecxão com o banco de dados pq eu declarei no meu container $container->set('db',$capsule);




$app->run();