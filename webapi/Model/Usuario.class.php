<?php

require('Banco.class.php');

class Usuario{
    public $id;
    public $nome_completo;
    public $email;
    public $senha;

    // Métodos:
    public function ValidarLogin(){
        $banco = Banco::conectar();
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
        $comando = $banco->prepare($sql);
        // Subtituir as interrogações por valores:
        $comando->execute(array($this->email, hash('sha256',$this->senha)));
        // "Salvar" o resultado da consulta (tabela) na $resultado
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);

        Banco::desconectar();

        return $resultado;
    }

    public function Cadastrar(){
        $banco = Banco::conectar();
        $sql = "INSERT INTO usuarios (nome_completo, email, senha) VALUES (?,?,?)";
        $banco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $comando = $banco->prepare($sql);
        // Tirar o hash da senha:
        $hash_senha = hash('sha256', $this->senha);
        // Tratamento de erro:
        try{
            $comando->execute(array($this->nome_completo, $this->email, $hash_senha));
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

    public function Editar(){
        $banco = Banco::conectar();

        if(isset($this->senha)){

            $sql = "UPDATE usuarios SET nome_completo = ?, email = ?, senha = ? 
        WHERE id = ?";

        }else{
            $sql = "UPDATE usuarios SET nome_completo = ?, email = ? WHERE id = ?";
        }

        $banco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $comando = $banco->prepare($sql);
       
        // Tratamento de erro:
        try{
            if(isset($this->senha)){
                // Tirar o hash da senha:
                $hash_senha = hash('sha256', $this->senha);
                $comando->execute(array($this->nome_completo, $this->email, $hash_senha,
                $this->id));
            }else{
                $comando->execute(array($this->nome_completo, $this->email, $this->id));
            }
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
}

?>