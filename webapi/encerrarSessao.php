<?php

header('Content-Type: application/json; charset=utf-8');

// Array de status:
$status = ['status' => 0, 'msg' => ''];

session_start();

if(!isset($_SESSION['infos'])){
    $status['msg'] = "Você nunca esteve logado!";
    echo json_encode($status);
}else{
    session_unset();
    setcookie(session_name(),'',0,'/');
    $status['msg'] = "Você foi desconectado!";
    $status['status'] = 1;
    echo json_encode($status);
}
?>