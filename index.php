<?php

function autoload_function($class){
    require_once "$class.php";
}

spl_autoload_register('autoload_function');

require_once 'conexao.php';
require_once 'Util.php';

echo "<table>";
echo Util::montaLinha(['ID','Título','Preço','ISBN','Edição','Ano', 'Editora'], 'th');
$statement = $pdo->query('SELECT * FROM livro LEFT JOIN editora ON livro.editora_id = editora.id');
while ($row = $statement->fetch()){

    $livro = Util::rowParaObject($row, 'Livro');
    $livro->editora = Util::rowParaObject($row, 'Editora', 'nome', 'editora_id');
    echo Util::montaLinha([
        $livro->id,
        $livro->titulo,
        $livro->titulo,
        $livro->isbn, 
        $livro->edicao, 
        $livro->ano, 
        $livro->editora->nome]);
}
