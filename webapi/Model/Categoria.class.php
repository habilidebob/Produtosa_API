<?php
require_once('Banco.class.php');

class Categoria{
    public $id;
    public $nome_categoria;


    public function Cadastrar(){
        $banco = Banco::conectar();
        $sql = "INSERT INTO categorias (nome_categoria) VALUES (?)";
        $banco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $comando = $banco->prepare($sql);
        // Tratamento de erro:
        try{
            $comando->execute(array($this->nome_categoria));
            Banco::desconectar();
            // Se der certo, devolve 1
            return 1;
        }catch(PDOException $e){
           // return $e->getCode(); 
           Banco::desconectar();
           // Se der errado, devolve 0:
           return 0;
        }
    }

    public static function Listar(){
        $banco = Banco::conectar();
        $sql = "SELECT * FROM categorias ORDER BY nome_categoria";
        $comando = $banco->prepare($sql);
        $comando->execute();
        // "Salvar" o resultado da consulta (tabela) na $resultado
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);

        Banco::desconectar();

        return $resultado;
    }
}

?>