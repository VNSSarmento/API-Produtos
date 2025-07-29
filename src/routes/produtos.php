<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Produto;


$app->group(
    '/api/v1',
    function ($group) {
        $group->get('/produtos/listar', function (Request $resquest, Response $response) {
            $produto = Produto::get(); //isso faz um select * from produtos.

            $response->getBody()->write(json_encode($produto));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        });

        $group->post('/produtos/adicionar', function (Request $request, Response $response) {
            $dados = $request->getParsedBody();
            $produto = Produto::create($dados); //isso faz um insert into

            $response->getBody()->write(json_encode($produto));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        });
    }

);
