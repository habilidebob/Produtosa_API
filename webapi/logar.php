<?php

header('Content-Type: application/json; charset=utf-8');

// Array de status:
$status = ['status' => 0, 'msg' => ''];

// Verificar se a api está sendo carregada por POST:
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(isset($_POST['email']) && isset($_POST['senha'])){
            require_once('Model/Usuario.class.php');
            $usuario = new Usuario();

            $usuario->email = $_POST['email'];
            $usuario->senha = $_POST['senha'];

            $resultado = $usuario->ValidarLogin();
            if(count($resultado) > 0){
                // Criar sessão:
                session_start();
                $_SESSION['infos'] = $resultado;
                // Array de resultados:
                $r = ['status' => 1, 'id_sessao' => session_id()];
                echo json_encode($r);
            }else{
                $status['msg'] = 'Usuario e/ou senhas incorretos.';
                echo json_encode($status);
            }

        }else{
            $status['msg'] = 'Os campos obrigatórios não foram definidos.';
            echo json_encode($status);
        }


    }else{
        // Retornar erro em caso de acesso por GET:
        $status['msg'] = 'A requisição deve ser realizada por POST.';
        echo json_encode($status);
    }

?>