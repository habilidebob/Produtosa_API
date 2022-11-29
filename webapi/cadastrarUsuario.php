<?php
header('Content-Type: application/json; charset=utf-8');

// Array de status:
$status = ['status' => 0, 'msg' => ''];

// Verificar se a api está sendo carregada por POST:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once('Model/Usuario.class.php');

    // Verificar se os campos estão setados:
    if(isset($_POST['email']) && isset($_POST['nome']) && 
    isset($_POST['senha'])){

        $usuario = new Usuario();
        $usuario->email = $_POST['email'];
        $usuario->nome_completo = $_POST['nome'];
        $usuario->senha = $_POST['senha'];

        // Chamar o método de cadastro:
        $r = $usuario->Cadastrar();

        if($r == 1){
            $status['msg'] = 'Cadastro realizado com sucesso.';
            $status['status'] = 1;
            echo json_encode($status);
        }else{
            $status['msg'] = 'Houve um problema no cadastro.';
            echo json_encode($status);
        }

    }else{
        $status['msg'] = 'Campos obrigatórios não definidos.';
        echo json_encode($status);
    }

}else{
    // Retornar erro em caso de acesso por GET:
    $status['msg'] = 'A requisição deve ser realizada por POST.';
    echo json_encode($status);
}


?>