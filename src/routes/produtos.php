<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Produto;


$app->group('/api/v1',function ($group) {
        //lista todos os produtos
        $group->get('/produtos/listar', function (Request $resquest, Response $response) {
            $produto = Produto::get(); //isso faz um select * from produtos.

            $response->getBody()->write(json_encode($produto));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        });
        //adiciona todos os produtos
        $group->post('/produtos/adicionar', function (Request $request, Response $response) {
            $dados = $request->getParsedBody();
            $produto = Produto::create($dados); //isso faz um insert into

            $response->getBody()->write(json_encode($produto));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        });
        //busca produto por ID
        $group->get('/produto/listar/{id}',function (Request $request, Response $response,$args){
            $id = $args['id'];
            $produto = Produto::findOrFail($id);
            $response->getBody()->write(json_encode($produto));

            return $response->withHeader('Content-Type','application/json')
                            ->withStatus(200);
        });
        //atualiza produto
        $group->put('/produto/atualizar/{id}',function (Request $request, Response $response,$args){
            $id = $args['id'];
            $dados = $request->getParsedBody();

            $produto = Produto::findOrFail($id);
            $produto->update($dados);
            $response->getBody()->write(json_encode($produto));

            return $response->withHeader('Content-Type','application/json')
                            ->withStatus(200);
        });

        $group->delete('/produto/remover/{id}',function (Request $request, Response $response,$args){
            $id = $args['id'];
            $produto = Produto::findOrFail($id);
            $produto->delete();
            return $response->withStatus(204);
        });

    }
);

