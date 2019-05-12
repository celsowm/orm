<?php

function autoload_function($class){
    require_once "$class.php";
}

spl_autoload_register('autoload_function');

require_once 'conexao.php';
require_once 'Util.php';

echo "<table border>";
echo Util::montaLinha(['ID','Título','Preço','ISBN','Edição','Ano', 'Editora', 'Autor(es)'], 'th');
$statement = $pdo->query(
        'SELECT livro.*, livro.id as livro_id, editora.nome FROM livro '
        . 'LEFT JOIN editora ON livro.editora_id = editora.id');

while ($row = $statement->fetch()){
    
    $livro = Util::rowParaObject($row, 'Livro');
    $livro->editora = Util::rowParaObject($row, 'Editora', 'nome');
    $livro->autores = (function ($row) use ($pdo){
        $autores   = [];
        $statement = $pdo->query("SELECT autor.* FROM autor "
                  . " INNER JOIN autor_livro ON autor.id = autor_livro.autor_id"
                  . " WHERE livro_id = {$row['livro_id']}");
        $result = $statement->fetchAll();          
        array_walk($result, function($row) use (&$autores) {
            $autores[] = Util::rowParaObject($row, 'Autor');
        });        
        return $autores;
    })($row);
    
    echo Util::montaLinha([
        $livro->id,
        $livro->titulo,
        $livro->preco,
        $livro->isbn, 
        $livro->edicao, 
        $livro->ano, 
        $livro->editora->nome,
        implode('; ',array_column($livro->autores, 'nome'))
        ]);
}
echo "</table>";
