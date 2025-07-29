<?php
require __DIR__.'/vendor/autoload.php';

$capsule = require __DIR__.'/config/database.php';

$schema = $capsule->schema();
$tabela = 'produto';

$schema->dropIfExists($tabela);

$schema->create($tabela,function($table){
        $table->increments('id');
        $table->string('titulo','50');
        $table->text('descricao');
        $table->decimal('preco',11,2);
        $table->string('fabricante',60);
        $table->date('dt_criacao');
});

$capsule->table($tabela)->insert([
    'titulo' => 'Celular',
    'descricao' => 'Celular Sansung novo',
    'preco' => 1200.4,
    'fabricante' => 'Samsung',
    'dt_criacao' => '2025-03-13' 
]);