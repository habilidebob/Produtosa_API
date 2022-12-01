<?php
header('Content-Type: application/json; charset=utf-8');

// Array de status:
$arr_erro = ['status' => 0, 'msg' => ''];

if(isset($_GET['id'])){
    session_start();
    if(isset($_SESSION['infos'])){
        require_once('Model/Produto.class.php');
        $produto = new Produto();
        $produto->id = $_GET['id'];
        if($produto->Apagar() >= 1){
            $arr_erro['status'] = 1;
            $arr_erro['msg'] = "Produto apagado com sucesso.";
            echo json_encode($arr_erro);
        }else{
            $arr_erro['msg'] = "Houve um erro ao apagar o produto.";
            echo json_encode($arr_erro);
        }
    }else{
        $arr_erro['msg'] = "Você não está logado.";
        echo json_encode($arr_erro);
    }
}else{
     // Mostrar um erro:
     $arr_erro['msg'] = "O ID não foi setado.";
     echo json_encode($arr_erro);
}
?>