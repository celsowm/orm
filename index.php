<?php

function autoload_function($class){
    require_once "$class.php";
}

spl_autoload_register('autoload_function');

require_once 'conexao.php';
require_once 'Util.php';

$statement = $pdo->query('SELECT * FROM livro LEFT JOIN editora ON livro.editora_id = editora.id');
while ($row = $statement->fetch()){

    $livro = Util::rowParaObject($row, 'Livro', 'id', 'titulo');
    $livro->editora = Util::rowParaObject($row, 'Editora', 'nome', 'editora_id');
    echo "Livro id: {$livro->id} titulo {$livro->titulo} da editora id {$livro->editora->id} {$livro->editora->nome}". "<br>";
}
