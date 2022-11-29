<?php
header('Content-Type: application/json; charset=utf-8');
// Esperado: obterProduto.php?id=10

// Array de erro:
$arr_erro = ['status' => 0, 'msg' => ''];

if(isset($_GET['id'])){
    require_once('Model/Produto.class.php');
    // Mostrar as informações:
    $produto = new Produto();
    $produto->id = $_GET['id'];

    $r = $produto->BuscarPorID();
    
    // Verificar se existem linhas no resultado:
    if(count($r)>0){
        echo json_encode($r);
    }else{
        // Mostrar erro:
        $arr_erro['msg'] = 'Produto inexistente!';
        echo json_encode($arr_erro);
    }

}else{
    // Mostrar um erro:
    $arr_erro['msg'] = "O ID não foi setado.";
    echo json_encode($arr_erro);

}

?>