<?php

class Editora {
    
    public $id;
    public $nome;
    
    //Usar método mágico para resolver problemas de conflito e até usar apelidos no SELECT!
    public function __set($name, $value) {
        
        switch ($name) {
            case 'editora_id':

                $this->id = $value;

                break;

            default:
                break;
        }
        
    }
    
}

