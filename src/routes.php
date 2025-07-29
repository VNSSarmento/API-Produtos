<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
 
require __DIR__ . '/routes/produto.php';

$app->group('/api/v1',function($group){
    $group->get('/produtos',function(Request $resquest,Response $response){
        $dado = [
            'nome' => 'vinicius',
            'idade' => 26
        ];
        $response->getBody()->write(json_encode($dado));
        return $response->withHeader('Content-Type','application/json')
                        ->withStatus(200);
    });
}
     
);



